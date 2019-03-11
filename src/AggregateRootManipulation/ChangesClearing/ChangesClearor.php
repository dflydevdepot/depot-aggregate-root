<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\ChangesClearing;

interface ChangesClearor
{
    /**
     * @param mixed $object
     *
     * @return void
     */
    public function clearChanges($object);
}
