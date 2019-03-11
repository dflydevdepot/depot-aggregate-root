<?php

namespace Depot\Testing\Unit\AggregateRoot\AggregateRootManipulation\ChangesExtraction;

use Depot\AggregateRoot\AggregateRootManipulation\ChangesExtraction\PublicMethodChangesExtractor;
use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\ChangesExtraction;
use PHPUnit\Framework\TestCase;

class PublicMethodChangeExtractorTest extends TestCase
{
    public function testHappyChangeExtractorCalledOnce()
    {
        $object = $this
            ->getMockBuilder(ChangesExtraction::class)
            ->getMock();

        $object->expects($this->once())->method('getAggregateRootChanges');

        $changeExtractor = new PublicMethodChangesExtractor();

        $changeExtractor->extractChanges($object);
    }

    public function testUnhappyChangeExtractorCalledOnce()
    {
        $this->expectException(AggregateRootNotSupported::class);
        $object = new \DateTimeImmutable();

        $changeExtractor = new PublicMethodChangesExtractor();

        $changeExtractor->extractChanges($object);
    }
}
