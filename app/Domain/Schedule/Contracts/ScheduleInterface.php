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
     * @var string SCHEDULE_TYPE_PLANNING
     */
    public const SCHEDULE_TYPE_PLANNING = 'planning';

    /**
     * @var string[] SCHEDULE_COLORS
     */
    public const SCHEDULE_COLORS = [
        self::SCHEDULE_TYPE_RECIPE => '#330000',
        self::SCHEDULE_TYPE_RENDEZVOUS => '#003300',
        self::SCHEDULE_TYPE_PLANNING => '#000033',
    ];
}