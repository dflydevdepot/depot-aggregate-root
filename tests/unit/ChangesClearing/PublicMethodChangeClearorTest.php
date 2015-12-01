<?php

use Depot\AggregateRoot\ChangesClearing\PublicMethodChangesClearor;
use PHPUnit_Framework_TestCase as TestCase;

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

    /** @expectedException AggregateRootNotSupported */
    public function testUnhappyChangeClearorCalledOnce()
    {
        $this->setExpectedException('Depot\AggregateRoot\Error\AggregateRootNotSupported');
        $object = new \DateTimeImmutable();

        $changeClearor = new PublicMethodChangesClearor();
        $changeClearor->clearChanges($object);
    }
}
