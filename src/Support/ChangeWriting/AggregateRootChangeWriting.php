<?php

namespace Depot\AggregateRoot\Support\ChangeWriting;

interface AggregateRootChangeWriting
{
    /**
     * @return static
     */
    public static function instantiateAggregateChangeFromEventAndMetadata();
}
