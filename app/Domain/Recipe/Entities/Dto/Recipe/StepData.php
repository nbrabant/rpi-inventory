<?php

namespace App\Domain\Recipe\Entities\Dto\Recipe;

use App\Infrastructure\Entities\Dto;

/**
 * @property int id
 * @property string name
 * @property string instruction
 * @property int position
 */
class StepData extends Dto
{
    /**
     * @param $step
     * @return static
     */
    public static function fromAttribute($step): self
    {
        return new static([
            'id'            => $step['id'],
            'name'          => $step['name'],
            'instruction'   => $step['instruction'],
            'position'      => $step['position'],
        ]);
    }
}