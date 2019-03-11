<?php

namespace Depot\AggregateRoot\ChangeManipulation\Reading;

use Depot\AggregateRoot\Error\AggregateRootNotSupported;
use Depot\AggregateRoot\Support\Change\Reading;

class PublicMethodsChangeReader implements Reader
{
    /**
     * @var string
     */
    private $readEventMethodName;

    /**
     * @var string
     */
    private $readMetadataMethodName;

    /**
     * @var string
     */
    private $canReadEventIdMethodName;

    /**
     * @var string
     */
    private $readEventIdMethodName;

    /**
     * @var string
     */
    private $canReadEventVersionMethodName;

    /**
     * @var string
     */
    private $readEventVersionMethodName;

    /**
     * @var string
     */
    private $readWhenMethodName;

    /**
     * @var string
     */
    private $supportedObjectType;

    /**
     * @param string $readEventMethodName
     * @param string $readMetadataMethodName
     * @param string $canReadEventIdMethodName
     * @param string $readEventIdMethodName
     * @param string $canReadEventVersionMethodName
     * @param string $readEventVersionMethodName
     * @param string $readWhenMethodName
     * @param $supportedObjectType
     */
    public function __construct(
        $readEventMethodName = 'getAggregateRootEvent',
        $readMetadataMethodName = 'getAggregateRootMetadata',
        $canReadEventIdMethodName = 'getCanReadAggregateRootEventId',
        $readEventIdMethodName = 'getAggregateRootEventId',
        $canReadEventVersionMethodName = 'getAggregateRootEventVersion',
        $readEventVersionMethodName = 'getAggregateRootEventVersion',
        $readWhenMethodName = 'getAggregateRootEventWhen',
        $supportedObjectType = Reading::class
    ) {
        $this->readEventMethodName = $readEventMethodName;
        $this->readMetadataMethodName = $readMetadataMethodName;
        $this->canReadEventIdMethodName = $canReadEventIdMethodName;
        $this->readEventIdMethodName = $readEventIdMethodName;
        $this->canReadEventVersionMethodName = $canReadEventVersionMethodName;
        $this->readEventVersionMethodName = $readEventVersionMethodName;
        $this->readWhenMethodName = $readWhenMethodName;
        $this->supportedObjectType = $supportedObjectType;
    }

    /**
     * {@inheritdoc}
     */
    public function readEvent($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->readEventMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function readMetadata($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->readMetadataMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function canReadEventId($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->canReadEventIdMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function readEventId($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->readEventIdMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function canReadEventVersion($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->canReadEventVersionMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function readEventVersion($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->readEventVersionMethodName]);
    }

    /**
     * {@inheritdoc}
     */
    public function readWhen($change)
    {
        $this->assertObjectIsSupported($change);

        return call_user_func([$change, $this->readWhenMethodName]);
    }

    private function assertObjectIsSupported($object)
    {
        if ($object instanceof $this->supportedObjectType) {
            return;
        }

        throw AggregateRootNotSupported::becauseObjectHasAnUnexpectedType(
            $object,
            $this->supportedObjectType
        );
    }
}
