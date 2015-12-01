<?php

namespace Depot\AggregateRoot\ChangesExtraction;

interface ChangesExtractor
{
    /**
     * @param mixed $object
     *
     * @return array
     */
    public function extractChanges($object);
}
