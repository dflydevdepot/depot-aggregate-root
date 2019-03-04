<?php

namespace Depot\Testing\Unit\AggregateRoot\ChangesExtraction;

use Depot\AggregateRoot\ChangesExtraction\PublicMethodChangesExtractor;
use Depot\AggregateRoot\Support\ChangesExtraction\AggregateRootChangesExtraction;
use PHPUnit\Framework\TestCase;

class PublicMethodChangeExtractorTest extends TestCase
{
    public function testHappyChangeExtractorCalledOnce()
    {
        // Create a mock of AggregateRootChangesClearing
        // only mock the clearAggregateChanges() method.
        $object = $this
            ->getMockBuilder(AggregateRootChangesExtraction::class)
            ->setMethods(array('getAggregateChanges'))
            ->getMock();
        // We only expect the clearAggregateChanges method to be called once
        $object->expects($this->once())->method('getAggregateChanges');

        $changeExtractor = new PublicMethodChangesExtractor();
        $changeExtractor->extractChanges($object);

    }

    /** @expectedException \Depot\AggregateRoot\Error\AggregateRootNotSupported */
    public function testUnhappyChangeExtractorCalledOnce()
    {
        $object = new \DateTimeImmutable();

        $changeExtractor = new PublicMethodChangesExtractor();
        $changeExtractor->extractChanges($object);
    }
}
