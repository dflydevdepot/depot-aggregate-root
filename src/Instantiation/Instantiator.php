<?php

namespace Depot\AggregateRoot\Instantiation;

interface Instantiator
{
    /**
     * @param string $className
     *
     * @return mixed
     */
    public function instantiateForReconstitution($className);
}
