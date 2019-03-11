<?php

namespace Depot\AggregateRoot\Support\Change;

interface Reading
{
    /**
     * @return object
     */
    public function getAggregateRootEvent();

    /**
     * @return object
     */
    public function getAggregateRootMetadata();

    /**
     * @return bool
     */
    public function getCanReadAggregateRootEventId();

    /**
     * @return object
     */
    public function getAggregateRootEventId();

    /**
     * @return bool
     */
    public function getCanReadAggregateRootEventVersion();

    /**
     * @return object
     */
    public function getAggregateRootEventVersion();

    /**
     * @return object
     */
    public function getAggregateRootEventWhen();
}
