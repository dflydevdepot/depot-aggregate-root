<?php

namespace Depot\AggregateRoot\ChangeManipulation\Writing;

class ChangeIsEventWriter implements Writer
{
    public function writeChange($eventId, $event, $when = null, $metadata = null, $version = null)
    {
        return $event;
    }
}
