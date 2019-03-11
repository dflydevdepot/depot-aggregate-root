<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface ChangesExtraction
{
    /**
     * @return array
     */
    public function getAggregateRootChanges();
}
