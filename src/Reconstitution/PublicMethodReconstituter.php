<?php

namespace Depot\AggregateRoot\Reconstitution;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\Reconstitution\AggregateRootReconstitution;

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

    /**
     * @param string $reconstituteMethod popRecordedChanges
     */
    public function __construct(
        $reconstituteMethod = 'reconstituteAggregateFrom',
        $supportedObjectType = AggregateRootReconstitution::class
    ) {
        $this->reconstituteMethod = $reconstituteMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
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
