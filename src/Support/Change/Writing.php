<?php

namespace Depot\AggregateRoot\Support\Change;

interface Writing
{
    /**
     * @return static
     */
    public static function instantiateChangeFromEventAndMetadata(
        $eventId,
        $event,
        $when = null,
        $metadata = null,
        $version = null
    );
}
