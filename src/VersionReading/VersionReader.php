<?php

namespace Depot\AggregateRoot\VersionReading;

interface VersionReader
{
    /**
     * @param $object
     *
     * @return int
     */
    public function readVersion($object);
}
