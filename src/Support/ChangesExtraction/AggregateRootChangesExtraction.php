<?php

namespace Depot\AggregateRoot\Support\ChangesExtraction;

interface AggregateRootChangesExtraction
{
    /**
     * @return array
     */
    public function getAggregateChanges();
}
