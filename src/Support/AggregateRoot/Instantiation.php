<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface Instantiation
{
    /**
     * @return static
     */
    public static function instantiateAggregateRootForReconstitution();
}
