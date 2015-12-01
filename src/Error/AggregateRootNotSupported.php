<?php

namespace Depot\AggregateRoot\Error;

use InvalidArgumentException;

class AggregateRootNotSupported extends InvalidArgumentException
{
    /**
     * @param mixed $object
     *
     * @return self
     */
    public static function becauseObjectHasAnUnexpectedType(
        $object,
        $expectedType
    ) {
        return new AggregateRootNotSupported(sprintf(
            'Aggregate object type "%s" is not an instance of "%s".',
            get_class($object),
            $expectedType
        ));
    }

    public static function becauseClassDoesNotHaveAnExpectedStaticMethod(
        $className,
        $expectedStaticMethodName
    ) {
        return new self(sprintf(
            'Aggregate class "%s" does not have a static method named "%s".',
            $className,
            $expectedStaticMethodName
        ));
    }
}
