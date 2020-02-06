<?php

namespace Terminal42\SwissbillingApi\Soap;

use Terminal42\SwissbillingApi\Type\AbstractType;

abstract class Api extends \SoapClient
{
    public function __call($function_name, $arguments)
    {
        foreach ($arguments as &$argument) {
            $this->convertArgument($argument);
        }

        unset($argument);

        return parent::__call($function_name, $arguments);
    }

    private function convertArgument(&$value)
    {
        switch (true) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case $value instanceof AbstractType:
                $value = (array) $value;
                // no break;

            case \is_array($value):
                array_walk($value, [$this, 'convertArgument']);
                break;

            case \is_object($value) && \method_exists($value, '__toString'):
                $value = (string) $value;
                break;
        }
    }
}
