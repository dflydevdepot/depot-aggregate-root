<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\VersionReading;

interface VersionReader
{
    /**
     * @param $object
     *
     * @return int
     */
    public function readVersion($object);
}
