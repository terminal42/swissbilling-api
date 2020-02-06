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


    //    public function getData(): array
//    {
//        $data = [];
//
//        foreach ($this->data as $k => $v) {
//            switch (true) {
//                case $v instanceof self:
//                    $data[$k] = $v->getData();
//                    break;
//
//                case \is_object($v) && \method_exists($v, '__toString'):
//                    $data[$k] = (string) $v;
//                    break;
//
//                default:
//                    $data[$k] = $v;
//                    break;
//            }
//        }
//
//        return $data;
//    }
}
