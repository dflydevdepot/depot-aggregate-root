<?php

namespace Depot\AggregateRoot\Support\Instantiation;

interface AggregateRootInstantiation
{
    /**
     * @return static
     */
    public static function instantiateAggregateForReconstitution();
}
