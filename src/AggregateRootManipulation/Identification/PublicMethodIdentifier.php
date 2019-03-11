<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\Identification;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\Identification;

class PublicMethodIdentifier implements Identifier
{
    /**
     * @var string
     */
    private $identifyMethod;

    /**
     * @var string
     */
    private $supportedObjectType;

    /**
     * @param string $extractChangesMethod getAggregateIdentity
     */
    public function __construct(
        $extractChangesMethod = 'getAggregateRootIdentity',
        $supportedObjectType = Identification::class
    ) {
        $this->identifyMethod = $extractChangesMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
    public function identify($object)
    {
        $this->assertObjectIsSupported($object);

        return call_user_func([$object, $this->identifyMethod]);
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
