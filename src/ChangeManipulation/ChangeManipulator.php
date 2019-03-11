<?php

namespace Depot\AggregateRoot\ChangeManipulation;

use Depot\AggregateRoot\ChangeManipulation\Reading\Reader;
use Depot\AggregateRoot\ChangeManipulation\Writing\Writer;

class ChangeManipulator implements Reader, Writer
{
    /**
     * @var Reader
     */
    private $changeReader;

    /**
     * @var Writer
     */
    private $changeWriter;

    public function __construct(
        Reader $reader,
        Writer $writer
    ) {
        $this->changeReader = $reader;
        $this->changeWriter = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function readEvent($change)
    {
        return $this->changeReader->readEvent($change);
    }

    /**
     * {@inheritdoc}
     */
    public function canReadEventId($change)
    {
        return $this->changeReader->canReadEventId($change);
    }

    /**
     * {@inheritdoc}
     */
    public function readEventId($change)
    {
        return $this->changeReader->readEventId($change);
    }

    /**
     * {@inheritdoc}
     */
    public function canReadEventVersion($change)
    {
        return $this->changeReader->canReadEventVersion($change);
    }

    /**
     * {@inheritdoc}
     */
    public function readEventVersion($change)
    {
        return $this->changeReader->readEventVersion($change);
    }

    /**
     * {@inheritdoc}
     */
    public function readMetadata($change)
    {
        return $this->changeReader->readMetadata($change);
    }

    /**
     * {@inheritdoc}
     */
    public function readWhen($change)
    {
        return $this->changeReader->readWhen($change);
    }

    /**
     * {@inheritdoc}
     */
    public function writeChange($eventId, $event, $when = null, $metadata = null, $version = null)
    {
        return $this->changeWriter->writeChange($eventId, $event, $when, $metadata, $version);
    }
}
