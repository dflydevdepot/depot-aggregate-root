<?php

namespace Depot\AggregateRoot\Support\VersionReading;

interface AggregateRootVersionReading
{
    /**
     * @return object
     */
    public function getAggregateVersion();
}
