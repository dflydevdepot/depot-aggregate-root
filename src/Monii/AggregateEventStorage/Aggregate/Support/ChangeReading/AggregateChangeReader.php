<?php

namespace Monii\AggregateEventStorage\Aggregate\Support\ChangeReading;

interface AggregateChangeReader
{
    /**
     * @return object
     */
    public function getAggregateEvent();

    /**
     * @return object
     */
    public function getAggregateMetadata();

    /**
     * @return object
     */
    public function getCanReadAggregateEventId();

    /**
     * @return object
     */
    public function getAggregateEventId();


}
