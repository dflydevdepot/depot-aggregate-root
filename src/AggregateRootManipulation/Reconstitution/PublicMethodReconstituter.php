<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\Reconstitution;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\AggregateRoot\Reconstitution;

class PublicMethodReconstituter implements Reconstituter
{
    /**
     * @var string
     */
    private $reconstituteMethod;

    /**
     * @var string
     */
    private $supportedObjectType;

    public function __construct(
        $reconstituteMethod = 'reconstituteAggregateRootFrom',
        $supportedObjectType = Reconstitution::class
    ) {
        $this->reconstituteMethod = $reconstituteMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    public function reconstitute($object, array $events)
    {
        $this->assertObjectIsSupported($object);

        call_user_func([$object, $this->reconstituteMethod], $events);
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
