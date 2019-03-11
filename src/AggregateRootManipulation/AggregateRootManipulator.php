<?php

namespace Depot\AggregateRoot\AggregateRootManipulation;

use Depot\AggregateRoot\AggregateRootManipulation\ChangesClearing\ChangesClearor;
use Depot\AggregateRoot\AggregateRootManipulation\ChangesExtraction\ChangesExtractor;
use Depot\AggregateRoot\AggregateRootManipulation\Identification\Identifier;
use Depot\AggregateRoot\AggregateRootManipulation\Instantiation\Instantiator;
use Depot\AggregateRoot\AggregateRootManipulation\Reconstitution\Reconstituter;
use Depot\AggregateRoot\AggregateRootManipulation\VersionReading\VersionReader;

class AggregateRootManipulator implements
    Instantiator,
    Reconstituter,
    Identifier,
    VersionReader,
    ChangesExtractor,
    ChangesClearor
{
    /**
     * @var Instantiator
     */
    private $instantiator;

    /**
     * @var Reconstituter
     */
    private $reconstituter;

    /**
     * @var Identifier
     */
    private $identifier;

    /**
     * @var VersionReader
     */
    private $versionReader;

    /**
     * @var ChangesExtractor
     */
    private $changesExtractor;

    /**
     * @var ChangesClearor
     */
    private $changesClearor;

    public function __construct(
        Instantiator $instantiator,
        Reconstituter $reconstituter,
        Identifier $identifier,
        VersionReader $versionReader,
        ChangesExtractor $changesExtractor,
        ChangesClearor $changesClearor
    ) {
        $this->instantiator = $instantiator;
        $this->reconstituter = $reconstituter;
        $this->identifier = $identifier;
        $this->versionReader = $versionReader;
        $this->changesExtractor = $changesExtractor;
        $this->changesClearor = $changesClearor;
    }

    /**
     * {@inheritdoc}
     */
    public function clearChanges($object)
    {
        $this->changesClearor->clearChanges($object);
    }

    /**
     * {@inheritdoc}
     */
    public function extractChanges($object)
    {
        return $this->changesExtractor->extractChanges($object);
    }

    /**
     * {@inheritdoc}
     */
    public function identify($object)
    {
        return $this->identifier->identify($object);
    }

    /**
     * {@inheritdoc}
     */
    public function readVersion($object)
    {
        return $this->versionReader->readVersion($object);
    }

    /**
     * {@inheritdoc}
     */
    public function instantiateForReconstitution($className)
    {
        return $this->instantiator->instantiateForReconstitution($className);
    }

    /**
     * {@inheritdoc}
     */
    public function reconstitute($object, array $events)
    {
        return $this->reconstituter->reconstitute($object, $events);
    }
}
