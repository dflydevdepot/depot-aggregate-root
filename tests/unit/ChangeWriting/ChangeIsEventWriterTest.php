<?php

use Depot\Testing\Fixtures\Banking\Account\AccountWasOpened;
use Depot\AggregateRoot\ChangeWriting\ChangeIsEventWriter;
use PHPUnit\Framework\TestCase;

class ChangeIsEventWriterTest extends TestCase
{
    public function testChangeIsEventReader()
    {
        $original_event = new AccountWasOpened('fixture-account-000', 25);
        $eventId = 0;
        $passthrough = new ChangeIsEventWriter;

        $this->assertEquals($original_event, $passthrough->writeChange($eventId, $original_event, new DateTimeImmutable('now')));
    }
}
