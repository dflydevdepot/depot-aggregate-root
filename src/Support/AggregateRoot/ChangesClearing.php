<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface ChangesClearing
{
    /**
     * @return array
     */
    public function clearAggregateRootChanges();
}
