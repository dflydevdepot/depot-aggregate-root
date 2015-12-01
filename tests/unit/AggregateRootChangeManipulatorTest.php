<?php

namespace Depot\Testing\Unit\AggregateRoot;

use Depot\AggregateRoot\AggregateRootChangeManipulator;
use Depot\AggregateRoot\ChangeReading\PublicMethodsChangeReader;
use Depot\AggregateRoot\ChangeWriting\ChangeIsEventWriter;
use Depot\AggregateRoot\ChangeWriting\NamedConstructorChangeWriter;
use Depot\Testing\Fixtures\Banking\Account\Account;
use Depot\Testing\Fixtures\Banking\Account\AccountBalanceDecreased;
use Depot\Testing\Fixtures\Banking\Account\AccountBalanceIncreased;
use Depot\Testing\Fixtures\Banking\Account\AccountWasOpened;
use Depot\Testing\Fixtures\Banking\Common\BankingEventEnvelope;
use PHPUnit_Framework_TestCase as TestCase;

class AggregateRootChangeManipulatorTest extends TestCase
{
    protected function getAccountFixture()
    {
        $account = Account::open(0,'fixture-account-000', 25);
        $account->increaseBalance(1,3);
        $account->decreaseBalance(2,2);
        $account->increaseBalance(3,5);

        return $account;
    }

    protected function getAccountFixtureBankingEventEnvelopes()
    {
        $now = new \DateTimeImmutable('now');

        return [
            BankingEventEnvelope::create(0, new AccountWasOpened('fixture-account-000', 25), null, 'metaData'),
            BankingEventEnvelope::create(1, new AccountBalanceIncreased('fixture-account-000', null, 3)),
            BankingEventEnvelope::create(2, new AccountBalanceDecreased('fixture-account-000', null, 2)),
            BankingEventEnvelope::create(3, new AccountBalanceIncreased('fixture-account-000', null, 5)),
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

    protected function getAggregateRootChangeManipulator()
    {
        return new AggregateRootChangeManipulator(
            new PublicMethodsChangeReader(),
            new NamedConstructorChangeWriter(BankingEventEnvelope::class)
        );
    }

    public function testReadEvent()
    {
        $eventEnvelope =  $this->getAccountFixtureBankingEventEnvelopes()[0];
        $actualEvent = $this->getAccountFixtureEvents()[0];

        $event = $this->getAggregateRootChangeManipulator()->readEvent($eventEnvelope);

        $this->assertEquals($actualEvent, $event);
    }

    public function testReadMetadata()
    {
        $eventEnvelope =  $this->getAccountFixtureBankingEventEnvelopes()[0];
        $metaData = 'metaData';

        $eventsMetaData = $this->getAggregateRootChangeManipulator()->readMetadata($eventEnvelope);

        $this->assertEquals($metaData, $eventsMetaData);
    }

    public function testWriteChange()
    {
        $event = new AccountWasOpened('fixture-account-000', 50);
        $eventId = 0;
        $eventEnvelope = BankingEventEnvelope::create(0, new AccountWasOpened('fixture-account-000', 50));
        $change = $this->getAggregateRootChangeManipulator()->writeChange($eventId, $event);

        $this->assertEquals($eventEnvelope, $change);
    }
}
