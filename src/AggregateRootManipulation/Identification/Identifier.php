<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\Identification;

interface Identifier
{
    /**
     * @param $object
     *
     * @return string
     */
    public function identify($object);
}
