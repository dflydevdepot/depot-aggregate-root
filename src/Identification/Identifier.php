<?php

namespace Depot\AggregateRoot\Identification;

interface Identifier
{
    /**
     * @param $object
     *
     * @return string
     */
    public function identify($object);
}
