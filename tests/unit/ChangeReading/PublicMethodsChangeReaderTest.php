<?php

namespace Depot\Testing\Unit\AggregateRoot\ChangeReading;

use Depot\AggregateRoot\ChangeReading\PublicMethodsChangeReader;
use Depot\AggregateRoot\Support\ChangeReading\AggregateRootChangeReading;
use PHPUnit_Framework_TestCase as TestCase;

class PublicMethodsChangeReaderTest extends TestCase
{
    public function testHappyChangeReaderCalledOnce()
    {
        // Create a mock of AggregateChangesReader
        // only mock the getAggregateEvent() method.
        $object = $this
            ->getMockBuilder(AggregateRootChangeReading::class)
            //->setMethods(array('getAggregateEvent'))
            ->getMock();
        // We only expect the getAggregateEvent method to be called once
        $object->expects($this->once())->method('getAggregateEvent');

        $changeClearor = new PublicMethodsChangeReader();
        $changeClearor->readEvent($object);

    }

    /**
     * @expectedException \Depot\AggregateRoot\Error\AggregateRootNotSupported
     */
    public function testUnhappyChangeReaderCalledOnce()
    {
        $object = new \DateTimeImmutable();

        $changeClearor = new PublicMethodsChangeReader();
        $changeClearor->readEvent($object);
    }
}
