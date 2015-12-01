<?php

namespace Depot\AggregateRoot\VersionReading;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\VersionReading\AggregateRootVersionReading;

class PublicMethodVersionReader implements VersionReader
{
    /**
     * @var string
     */
    private $readVersionMethod;

    /**
     * @var string
     */
    private $supportedObjectType;

    /**
     * @param string $readVersionMethod popRecordedChanges
     */
    public function __construct(
        $readVersionMethod = 'getAggregateVersion',
        $supportedObjectType = AggregateRootVersionReading::class
    ) {
        $this->readVersionMethod = $readVersionMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
    public function readVersion($object)
    {
        $this->assertObjectIsSupported($object);

        return call_user_func([$object, $this->readVersionMethod]);
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
