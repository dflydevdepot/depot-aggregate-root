<?php

namespace Depot\Testing\Unit\AggregateRoot;

use Depot\AggregateRoot\AggregateRootManipulator;
use Depot\AggregateRoot\ChangesExtraction\PublicMethodChangesExtractor;
use Depot\AggregateRoot\ChangesClearing\PublicMethodChangesClearor;
use Depot\AggregateRoot\Identification\PublicMethodIdentifier;
use Depot\AggregateRoot\Instantiation\NamedConstructorInstantiator;
use Depot\AggregateRoot\Reconstitution\PublicMethodReconstituter;
use Depot\AggregateRoot\VersionReading\PublicMethodVersionReader;
use Depot\Testing\Fixtures\Banking\Account\Account;
use Depot\Testing\Fixtures\Banking\Account\AccountBalanceDecreased;
use Depot\Testing\Fixtures\Banking\Account\AccountBalanceIncreased;
use Depot\Testing\Fixtures\Banking\Account\AccountWasOpened;
use Depot\Testing\Fixtures\Banking\Common\BankingEventEnvelope;
use PHPUnit\Framework\TestCase;

class AggregateRootManipulatorTest extends TestCase
{
    protected function getAccountFixture()
    {
        $account = Account::open(0, 'fixture-account-000', 25);
        $account->increaseBalance(1, 3);
        $account->decreaseBalance(2, 2);
        $account->increaseBalance(3, 5);

        return $account;
    }

    protected function getAccountFixtureBankingEventEnvelopes()
    {
        return [
            BankingEventEnvelope::create(0, new AccountWasOpened('fixture-account-000', 25)),
            BankingEventEnvelope::create(1, new AccountBalanceIncreased('fixture-account-000', 3)),
            BankingEventEnvelope::create(2, new AccountBalanceDecreased('fixture-account-000', 2)),
            BankingEventEnvelope::create(3, new AccountBalanceIncreased('fixture-account-000', 5)),
        ];
    }

    protected function getAccountFixtureEvents()
    {
        return [
            new AccountWasOpened('fixture-account-000', 25),
            new AccountBalanceIncreased('fixture-account-000', 3),
            new AccountBalanceDecreased('fixture-account-000', 2),
            new AccountBalanceIncreased('fixture-account-000', 5),
        ];
    }

    protected function getAggregateRootManipulator()
    {
        return new AggregateRootManipulator(
            new NamedConstructorInstantiator(),
            new PublicMethodReconstituter(),
            new PublicMethodIdentifier(),
            new PublicMethodVersionReader(),
            new PublicMethodChangesExtractor(),
            new PublicMethodChangesClearor()
        );
    }

    public function testInstantiation()
    {
        $account = $this->getAggregateRootManipulator()->instantiateForReconstitution(Account::class);

        $this->assertInstanceOf(Account::class, $account);
    }

    public function testReconstitution()
    {
        $account = Account::instantiateAggregateForReconstitution();

        $this->getAggregateRootManipulator()->reconstitute($account, $this->getAccountFixtureBankingEventEnvelopes());

        $this->assertEquals($this->getAccountFixtureEvents(), $account->getHandledEvents());
    }

    public function testChangesExtraction()
    {
        $account = $this->getAccountFixture();

        $bankingEventEnvelopes = $this->getAggregateRootManipulator()->extractChanges($account);

        $now = new \DateTimeImmutable('now');

        $removeTime = function (array $events) use ($now) {
            $rewrittenEvents = [];
            foreach ($events as $event) {
                /** @var $event BankingEventEnvelope */

                $rewrittenEvents[] = $event->withWhen($now);
            }
        };

        $this->assertEquals(
            $removeTime($this->getAccountFixtureBankingEventEnvelopes()),
            $removeTime($bankingEventEnvelopes)
        );

        $this->assertEquals(
            $removeTime($this->getAccountFixtureBankingEventEnvelopes()),
            $removeTime($bankingEventEnvelopes)
        );
    }

    public function testChangesClearing()
    {
        $account = $this->getAccountFixture();

        $this->getAggregateRootManipulator()->clearChanges($account);

        $bankingEventEnvelopes = $this->getAggregateRootManipulator()->extractChanges($account);

        $this->assertEquals([], $bankingEventEnvelopes);
    }

    public function testIdentification()
    {
        $account = $this->getAccountFixture();

        $accountId = $this->getAggregateRootManipulator()->identify($account);

        $this->assertEquals('fixture-account-000', $accountId);
    }

    public function testVersionReading()
    {
        $account = $this->getAccountFixture();

        $version = $this->getAggregateRootManipulator()->readVersion($account);

        $this->assertEquals(3, $version);
    }
}
