<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface VersionReading
{
    /**
     * @return object
     */
    public function getAggregateRootVersion();
}
