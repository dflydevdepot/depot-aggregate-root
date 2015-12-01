<?php

namespace Depot\AggregateRoot\Support\Identification;

interface AggregateRootIdentification
{
    /**
     * @return string
     */
    public function getAggregateIdentity();
}
