<?php

use Depot\Testing\Fixtures\Banking\Account\AccountWasOpened;
use Depot\AggregateRoot\ChangeReading\ChangeIsEventReader;
use PHPUnit_Framework_TestCase as TestCase;

class ChangeIsEventReaderTest extends TestCase
{
    public function testChangeIsEventReader()
    {
        $original_event = new AccountWasOpened('fixture-account-000', 25);

        $passthrough = new ChangeIsEventReader;

        $this->assertEquals($original_event, $passthrough->readEvent($original_event));
    }
}