<?php

use Depot\AggregateRoot\ChangeWriting\NamedConstructorChangeWriter;
use PHPUnit_Framework_TestCase as TestCase;

class NamedConstructorChangeWriterTest extends TestCase
{
    public function testHappyChangeWriteCalledOnce()
    {
        // Create a mock of AggregateRootChangesClearing
        // only mock the clearAggregateChanges() method.
       /* $object = $this
            ->getMockBuilder('Depot\AggregateRoot\Support\ChangeWriting\AggregateChangeWriter')
            ->setMethods(array('instantiateAggregateChangeFromEventAndMetadata'))
            ->getMock();
        // We only expect the clearAggregateChanges method to be called once
        $object->expects($this->once())->method('instantiateAggregateChangeFromEventAndMetadata');

        $changeClearor = new NamedConstructorChangeWriter();
        $changeClearor->writeChange($object);*/

    }

    ///** @expectedException AggregateRootNotSupported */
    public function testUnhappyChangeWriteCalledOnce()
    {
        /*$this->setExpectedException('Depot\AggregateRoot\Error\AggregateRootNotSupported');
        $object = new \DateTimeImmutable();

        $changeClearor = new NamedConstructorChangeWriter();
        $changeClearor->writeChange($object);*/
    }
}