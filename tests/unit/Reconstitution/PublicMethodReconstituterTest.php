<?php

use Depot\AggregateRoot\Reconstitution\PublicMethodReconstituter;
use PHPUnit\Framework\TestCase;

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

    public function testUnhappyReconstitution()
    {
        $this->expectException(\Depot\AggregateRoot\Error\AggregateRootNotSupported::class);
        $object = new \DateTimeImmutable();

        $reconstituter = new PublicMethodReconstituter();
        $reconstituter->reconstitute($object, array());

    }
}
