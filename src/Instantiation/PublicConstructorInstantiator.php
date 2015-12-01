<?php

namespace Depot\AggregateRoot\Instantiation;

class PublicConstructorInstantiator implements Instantiator
{
    /**
     * {@inheritdoc}
     */
    public function instantiateForReconstitution($className)
    {
        return new $className();
    }
}
