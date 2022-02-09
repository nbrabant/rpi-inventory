<?php

namespace App\Domain\Schedule\Entities\Dto;

use App\Domain\Schedule\Http\Requests\ScheduleRequest;
use App\Infrastructure\Entities\Dto;

class ScheduleData extends Dto
{
    /**
     * @param ScheduleRequest $request
     * @return self
     */
    public static function fromRequest(ScheduleRequest $request): self
    {
        return new static ([
            'recipe_id'     => $request->getRecipeId(),
            'user_id'       => $request->getUserId(),
            'type_schedule' => $request->getTypeSchedule(),
            'title'         => $request->getTitle(),
            'details'       => $request->getDetails(),
            'start_at'      => $request->getStartAt(),
            'end_at'        => $request->getEndAt(),
            'all_day'       => $request->getAllDay(),
        ]);
    }
}