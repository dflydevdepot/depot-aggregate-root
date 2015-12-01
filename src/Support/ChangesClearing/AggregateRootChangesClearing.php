<?php

namespace Depot\AggregateRoot\Support\ChangesClearing;

interface AggregateRootChangesClearing
{
    /**
     * @return array
     */
    public function clearAggregateChanges();
}
