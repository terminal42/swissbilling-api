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

    public function __toString()
    {
        return $this->dateTime->format('c');
    }
}
