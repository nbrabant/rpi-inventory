<?php

namespace App\Infrastructure\Entities\Filters;

use App\Infrastructure\Entities\ValueObject\EndDate;
use App\Infrastructure\Entities\ValueObject\StartDate;
use Carbon\Carbon;

class DateFilter
{
    /**
     * @var StartDate $startDate
     */
    public StartDate $startDate;
    /**
     * @var EndDate $endDate
     */
    public EndDate $endDate;

    public function __construct(StartDate $startDate, EndDate $endDate)
    {
        $this->endDate = $endDate;
        $this->startDate = $startDate;
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return static
     */
    public static function fromCarbons(Carbon $startDate, Carbon $endDate): self
    {
        return new static(
            StartDate::fromString($startDate->toString()),
            EndDate::fromString($endDate->toString())
        );
    }
}