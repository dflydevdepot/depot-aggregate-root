<?php

namespace Depot\AggregateRoot\Support\AggregateRoot;

interface AggregateRoot extends
    ChangesClearing,
    ChangesExtraction,
    Identification,
    Instantiation,
    Reconstitution,
    VersionReading
{
}