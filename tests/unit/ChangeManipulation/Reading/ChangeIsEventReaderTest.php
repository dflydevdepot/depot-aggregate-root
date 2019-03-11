<?php

namespace Depot\Testing\Unit\AggregateRoot\ChangeManipulation\Reading;

use Depot\Testing\Fixtures\Banking\Account\AccountWasOpened;
use Depot\AggregateRoot\ChangeManipulation\Reading\ChangeIsEventReader;
use PHPUnit\Framework\TestCase;

class ChangeIsEventReaderTest extends TestCase
{
    public function testChangeIsEventReader()
    {
        $original_event = new AccountWasOpened('fixture-account-000', 25);

        $passthrough = new ChangeIsEventReader;

        $this->assertEquals($original_event, $passthrough->readEvent($original_event));
    }
}
