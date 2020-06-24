<?php

namespace JsonContainer;

use Closure;
use ReflectionNamedType;

class Util
{
    /**
     * If the given value is not an array and not null, wrap it in one.
     *
     * From Arr::wrap() in JsonContainer\Support.
     *
     * @param  mixed  $value
     * @return array
     */
    public static function arrayWrap($value)
    {
        if (is_null($value)) {
            return [];
        }

        return is_array($value) ? $value : [$value];
    }

    /**
     * Return the default value of the given value.
     *
     * From global value() helper in JsonContainer\Support.
     *
     * @param  mixed  $value
     * @return mixed
     */
    public static function unwrapIfClosure($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

    /**
     * Get the class name of the given parameter's type, if possible.
     *
     * From Reflector::getParameterClassName() in JsonContainer\Support.
     *
     * @param  \ReflectionParameter  $parameter
     * @return string|null
     */
    public static function getParameterClassName($parameter)
    {
        $type = $parameter->getType();

        if (! $type instanceof ReflectionNamedType || $type->isBuiltin()) {
            return;
        }

        $name = $type->getName();

        if ($name === 'self') {
            return $parameter->getDeclaringClass()->getName();
        }

        return $name;
    }
}