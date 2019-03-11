<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\ChangesExtraction;

interface ChangesExtractor
{
    /**
     * @param mixed $object
     *
     * @return array
     */
    public function extractChanges($object);
}
