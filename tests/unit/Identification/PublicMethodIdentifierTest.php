<?php

namespace Depot\Testing\Unit\AggregateRoot\Identification;

use Depot\AggregateRoot\Identification\PublicMethodIdentifier;
use Depot\AggregateRoot\Support\Identification\AggregateRootIdentification;
use PHPUnit_Framework_TestCase as TestCase;

class PublicMethoddentifierTest extends TestCase
{
    public function testHappyIdentification()
    {
        $object = $this
            ->getMockBuilder(AggregateRootIdentification::class)
            ->setMethods(array('getAggregateIdentity'))
            ->getMock();
        $object->expects($this->once())->method('getAggregateIdentity');
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
