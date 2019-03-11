<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface Identification
{
    /**
     * @return string
     */
    public function getAggregateRootIdentity();
}
