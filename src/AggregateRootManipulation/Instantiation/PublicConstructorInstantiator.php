<?php

namespace Depot\AggregateRoot\AggregateRootManipulation\Instantiation;

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
