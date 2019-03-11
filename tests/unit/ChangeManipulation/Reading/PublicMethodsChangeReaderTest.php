<?php

namespace Depot\Testing\Unit\AggregateRoot\ChangeManipulation\Reading;

use Depot\AggregateRoot\ChangeManipulation\Reading\PublicMethodsChangeReader;
use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\Change\Reading;
use PHPUnit\Framework\TestCase;

class PublicMethodsChangeReaderTest extends TestCase
{
    public function testHappyChangeReaderCalledOnce()
    {
        $object = $this
            ->getMockBuilder(Reading::class)
            ->getMock();

        $object->expects($this->once())->method('getAggregateRootEvent');

        $changeClearor = new PublicMethodsChangeReader();
        $changeClearor->readEvent($object);
    }

    public function testUnhappyChangeReaderCalledOnce()
    {
        $this->expectException(AggregateRootNotSupported::class);

        $object = new \DateTimeImmutable();

        $changeClearor = new PublicMethodsChangeReader();
        $changeClearor->readEvent($object);
    }
}
