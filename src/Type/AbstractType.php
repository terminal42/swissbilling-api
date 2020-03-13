<?php

namespace Terminal42\SwissbillingApi\Type;

abstract class AbstractType extends \ArrayObject
{
    public function __get(string $key)
    {
        return $this->offsetGet($key);
    }

    public function __set(string $key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    public function __isset($key): bool
    {
        return $this->offsetExists($key);
    }

    public function __unset(string $key): void
    {
        $this->offsetUnset($key);
    }
}
