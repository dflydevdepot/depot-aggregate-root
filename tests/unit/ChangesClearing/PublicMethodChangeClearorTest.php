<?php

use Depot\AggregateRoot\ChangesClearing\PublicMethodChangesClearor;
use PHPUnit\Framework\TestCase;

class PublicMethodChangeClearorTest extends TestCase
{
    public function testHappyChangeClearorCalledOnce()
    {
        // Create a mock of AggregateRootChangesClearing
        // only mock the clearAggregateChanges() method.
        $object = $this
            ->getMockBuilder('Depot\AggregateRoot\Support\ChangesClearing\AggregateRootChangesClearing')
            ->setMethods(array('clearAggregateChanges'))
            ->getMock();
        // We only expect the clearAggregateChanges method to be called once
        $object->expects($this->once())->method('clearAggregateChanges');

        $changeClearor = new PublicMethodChangesClearor();
        $changeClearor->clearChanges($object);

    }

    public function testUnhappyChangeClearorCalledOnce()
    {
        $this->expectException(\Depot\AggregateRoot\Error\AggregateRootNotSupported::class);
        $object = new \DateTimeImmutable();

        $changeClearor = new PublicMethodChangesClearor();
        $changeClearor->clearChanges($object);
    }
}
