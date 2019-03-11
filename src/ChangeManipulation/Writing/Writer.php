<?php

namespace Depot\AggregateRoot\ChangeManipulation\Writing;

use DateTimeImmutable;

interface Writer
{
    /**
     * @param string $eventId
     * @param object $event
     * @param DateTimeImmutable|null $when
     * @param object|null $metadata
     * @param string|null $version
     *
     * @return object
     */
    public function writeChange($eventId, $event, $when = null, $metadata = null, $version = null);
}
