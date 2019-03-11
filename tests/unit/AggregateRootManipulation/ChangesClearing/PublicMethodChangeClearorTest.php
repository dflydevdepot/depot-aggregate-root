<?php

namespace Depot\Testing\Unit\AggregateRoot\AggregateRootManipulation\ChangesClearing;

use Depot\AggregateRoot\AggregateRootManipulation\ChangesClearing\PublicMethodChangesClearor;
use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\ChangesClearing;
use PHPUnit\Framework\TestCase;

class PublicMethodChangeClearorTest extends TestCase
{
    public function testHappyChangeClearorCalledOnce()
    {
        $object = $this
            ->getMockBuilder(ChangesClearing::class)
            ->getMock();

        $object->expects($this->once())->method('clearAggregateRootChanges');

        $changeClearor = new PublicMethodChangesClearor();
        $changeClearor->clearChanges($object);
    }

    public function testUnhappyChangeClearorCalledOnce()
    {
        $this->expectException(AggregateRootNotSupported::class);
        $object = new \DateTimeImmutable();

        $changeClearor = new PublicMethodChangesClearor();
        $changeClearor->clearChanges($object);
    }
}
