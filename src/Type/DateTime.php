<?php

namespace Terminal42\SwissbillingApi\Type;

class DateTime
{
    /**
     * @var \DateTime
     */
    private $dateTime;

    public function __construct(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function getTimestamp(): int
    {
        return $this->dateTime->format('U');
    }

    public function __toString(): string
    {
        return $this->dateTime->format('c');
    }
}
