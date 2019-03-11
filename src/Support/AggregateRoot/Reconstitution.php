<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface Reconstitution
{
    /**
     * @param array $events
     *
     * @return void
     */
    public function reconstituteAggregateRootFrom(array $events);
}
