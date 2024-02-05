<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Soap;

use Terminal42\SwissbillingApi\Exception\SoapException;
use Terminal42\SwissbillingApi\Type\AbstractType;

abstract class Api extends \SoapClient
{
    /**
     * @throws SoapException
     */
    public function __call($name, $args): mixed
    {
        foreach ($args as &$arg) {
            $this->convertArgument($arg);
        }

        unset($arg);

        try {
            return parent::__call($name, $args);
        } catch (\SoapFault $e) {
            throw new SoapException($e, $this);
        }
    }

    private function convertArgument(mixed &$value): void
    {
        switch (true) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case $value instanceof AbstractType:
                $value = (array) $value;
                // no break;

            case \is_array($value):
                array_walk($value, $this->convertArgument(...));
                break;

            case \is_object($value) && method_exists($value, '__toString'):
                $value = (string) $value;
                break;
        }
    }
}
