<?php

namespace Depot\AggregateRoot\Support;

use Depot\AggregateRoot\Support\ChangesClearing\AggregateRootChangesClearing;
use Depot\AggregateRoot\Support\ChangesExtraction\AggregateRootChangesExtraction;
use Depot\AggregateRoot\Support\Identification\AggregateRootIdentification;
use Depot\AggregateRoot\Support\Instantiation\AggregateRootInstantiation;
use Depot\AggregateRoot\Support\Reconstitution\AggregateRootReconstitution;
use Depot\AggregateRoot\Support\VersionReading\AggregateRootVersionReading;

interface AggregateRootEventStorage extends
    AggregateRootInstantiation,
    AggregateRootChangesClearing,
    AggregateRootChangesExtraction,
    AggregateRootIdentification,
    AggregateRootReconstitution,
    AggregateRootVersionReading
{
}
