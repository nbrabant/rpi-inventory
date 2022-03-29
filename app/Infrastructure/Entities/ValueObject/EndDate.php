<?php

namespace App\Infrastructure\Entities\ValueObject;

use Carbon\Carbon;

class EndDate
{
    /**
     * @var Carbon $date
     */
    public Carbon $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date->endOfDay();
    }

    /**
     * @param string $date
     * @return static
     */
    public static function fromString(string $date): self
    {
        return new static(Carbon::parse($date));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }
}