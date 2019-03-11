<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\Instantiation;

interface Instantiator
{
    /**
     * @param string $className
     *
     * @return mixed
     */
    public function instantiateForReconstitution($className);
}
