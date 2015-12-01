<?php

namespace Depot\AggregateRoot\ChangesClearing;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\ChangesClearing\AggregateRootChangesClearing;

class PublicMethodChangesClearor implements ChangesClearor
{
    /**
     * @var string
     */
    private $clearChangesMethod;

    /**
     * @var string
     */
    private $supportedObjectType;

    /**
     * @param string $extractChangesMethod popRecordedChanges
     */
    public function __construct(
        $extractChangesMethod = 'clearAggregateChanges',
        $supportedObjectType = AggregateRootChangesClearing::class
    ) {
        $this->clearChangesMethod = $extractChangesMethod;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
    public function clearChanges($object)
    {
        $this->assertObjectIsSupported($object);

        return call_user_func([$object, $this->clearChangesMethod]);
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
