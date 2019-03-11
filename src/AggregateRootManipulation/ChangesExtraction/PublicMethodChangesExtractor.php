<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\ChangesExtraction;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\ChangesExtraction;

class PublicMethodChangesExtractor implements ChangesExtractor
{
    /**
     * @var string
     */
    private $extractChangesMethod;

    /**
     * @var string
     */
    private $supportedObjectType;

    public function __construct(
        $extractChangesMethod = 'getAggregateRootChanges',
        $supportedObjectType = ChangesExtraction::class
    ) {
        $this->extractChangesMethod = $extractChangesMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
    public function extractChanges($object)
    {
        $this->assertObjectIsSupported($object);

        return call_user_func([$object, $this->extractChangesMethod]);
    }

    private function assertObjectIsSupported($object)
    {
        if ($object instanceof $this->supportedObjectType) {
            return;
        }

        throw AggregateRootNotSupported::becauseObjectHasAnUnexpectedType(
            $object,
            $this->supportedObjectType
        );
    }
}
