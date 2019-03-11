<?php

namespace Depot\Testing\Unit\AggregateRoot\AggregateRootManipulation\Identification;

use Depot\AggregateRoot\AggregateRootManipulation\Reconstitution\PublicMethodReconstituter;
use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\Reconstitution;
use PHPUnit\Framework\TestCase;

class PublicMethodReconstituterTest extends TestCase
{
    public function testHappyReconstitution()
    {
        $object = $this
            ->getMockBuilder(Reconstitution::class)
            ->getMock();

        $object->expects($this->once())->method('reconstituteAggregateRootFrom');

        $reconstituter = new PublicMethodReconstituter();

        $reconstituter->reconstitute($object, array());
    }

    public function testUnhappyReconstitution()
    {
        $this->expectException(AggregateRootNotSupported::class);

        $object = new \DateTimeImmutable();

        $reconstituter = new PublicMethodReconstituter();

        $reconstituter->reconstitute($object, array());
    }
}
