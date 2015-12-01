<?php

namespace Depot\AggregateRoot\Support\Reconstitution;

interface AggregateRootReconstitution
{
    /**
     * @param array $events
     *
     * @return void
     */
    public function reconstituteAggregateFrom(array $events);
}
