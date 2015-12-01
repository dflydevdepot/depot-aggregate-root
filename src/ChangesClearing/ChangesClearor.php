<?php

namespace Depot\AggregateRoot\ChangesClearing;

interface ChangesClearor
{
    /**
     * @param mixed $object
     *
     * @return void
     */
    public function clearChanges($object);
}
