<?php

namespace Terminal42\SwissbillingApi\Type;

class DateTime
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var \DateTime
     */
    private $dateTime;

    public function __construct(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function __toString(): string
    {
        return $this->dateTime->format(self::DATE_FORMAT);
    }

    public static function create(string $time)
    {
        return new static(\DateTime::createFromFormat(self::DATE_FORMAT, $time));
    }
}
