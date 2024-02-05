<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

class DateTime implements \Stringable
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    public function __construct(private readonly \DateTime $dateTime)
    {
    }

    public function __toString(): string
    {
        return $this->dateTime->format(self::DATE_FORMAT);
    }

    public static function create(string $time): self
    {
        return new self(\DateTime::createFromFormat(self::DATE_FORMAT, $time));
    }
}
