<?php

namespace Depot\AggregateRoot\ChangeWriting;

use Depot\AggregateRoot\Error\AggregateRootChangeNotSupported;

class NamedConstructorChangeWriter implements ChangeWriter
{
    /**
     * @var string
     */
    private $changeClassName;

    /**
     * @var string
     */
    private $staticConstructorMethodName;

    public function __construct(
        $changeClassName,
        $staticConstructorMethod = 'instantiateAggregateChangeFromEventAndMetadata'
    ) {
        $this->changeClassName = $changeClassName;
        $this->staticConstructorMethodName = $staticConstructorMethod;
    }

    /**
     * {@inheritdoc}
     */
    public function writeChange($eventId, $event, $when = null, $metadata = null, $version = null)
    {
        $this->assertStaticMethodCallExists();

        $staticMethodCall = $this->getStaticMethodCall();

        $object = call_user_func($staticMethodCall, $eventId, $event, $when, $metadata, $version);

        return $object;
    }

    private function assertStaticMethodCallExists()
    {
        if (method_exists($this->changeClassName, $this->staticConstructorMethodName)) {
            return;
        }

        throw AggregateRootChangeNotSupported::becauseClassDoesNotHaveAnExpectedStaticMethod(
            $this->changeClassName,
            $this->staticConstructorMethodName
        );
    }

    private function getStaticMethodCall()
    {
        return sprintf('%s::%s', $this->changeClassName, $this->staticConstructorMethodName);
    }
}
