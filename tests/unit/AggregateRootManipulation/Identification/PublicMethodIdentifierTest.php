<?php

namespace Depot\Testing\Unit\AggregateRoot\AggregateRootManipulation\Identification;

use Depot\AggregateRoot\AggregateRootManipulation\Identification\PublicMethodIdentifier;
use Depot\AggregateRoot\Support\AggregateRoot\Identification;
use PHPUnit\Framework\TestCase;

class PublicMethoddentifierTest extends TestCase
{
    public function testHappyIdentification()
    {
        $object = $this
            ->getMockBuilder(Identification::class)
            ->getMock();

        $object->expects($this->once())->method('getAggregateRootIdentity');

        $identity = new PublicMethodIdentifier();

        $identity->identify($object);
    }

    /**
     * @expectedException \Depot\AggregateRoot\Error\AggregateRootNotSupported
     */
    public function testUnhappyIdentification()
    {
        $object = new \DateTimeImmutable();

        $identity = new PublicMethodIdentifier();
        $identity->identify($object);
    }
}
