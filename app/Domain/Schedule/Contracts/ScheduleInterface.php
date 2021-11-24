<?php

namespace App\Domain\Schedule\Contracts;

interface ScheduleInterface
{
    /**
     * @var string SCHEDULE_TYPE_RECIPE
     */
    public const SCHEDULE_TYPE_RECIPE = 'recette';
    /**
     * @var string SCHEDULE_TYPE_RENDEZVOUS
     */
    public const SCHEDULE_TYPE_RENDEZVOUS = 'rendezvous';
    /**
     * @var string SCHEDUDE_TYPE_PLANNING
     */
    public const SCHEDUDE_TYPE_PLANNING = 'planning';
}