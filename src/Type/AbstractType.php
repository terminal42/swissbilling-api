<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

/**
 * @extends \ArrayObject<string, mixed>
 */
abstract class AbstractType extends \ArrayObject
{
    public function __get(string $key): mixed
    {
        return $this->offsetGet($key);
    }

    public function __set(string $key, mixed $value): void
    {
        $this->offsetSet($key, $value);
    }

    public function __isset(string $key): bool
    {
        return $this->offsetExists($key);
    }

    public function __unset(string $key): void
    {
        $this->offsetUnset($key);
    }
}
