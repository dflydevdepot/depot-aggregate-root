<?php

use Depot\AggregateRoot\Reconstitution\PublicMethodReconstituter;
use PHPUnit_Framework_TestCase as TestCase;

class PublicMethodReconstituterTest extends TestCase
{
    public function testHappyReconstitution()
    {
        $object = $this
            ->getMockBuilder('Depot\AggregateRoot\Support\Reconstitution\AggregateRootReconstitution')
            ->setMethods(array('reconstituteAggregateFrom'))
            ->getMock();
        $object->expects($this->once())->method('reconstituteAggregateFrom');
        $reconstituter = new PublicMethodReconstituter();
        $reconstituter->reconstitute($object, array());
    }

    /** @expectedException AggregateRootNotSupported */
    public function testUnhappyReconstitution()
    {
        $this->setExpectedException('Depot\AggregateRoot\Error\AggregateRootNotSupported');
        $object = new \DateTimeImmutable();

        $reconstituter = new PublicMethodReconstituter();
        $reconstituter->reconstitute($object, array());

    }
}