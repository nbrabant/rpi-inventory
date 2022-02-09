<?php

namespace App\Domain\Schedule\Http\Requests;

use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int recipe_id
 * @property int user_id
 * @property string type_schedule
 * @property string title
 * @property string details
 * @property DateTimeInterface start_at
 * @property DateTimeInterface end_at
 * @property bool all_day
 */
class ScheduleRequest extends FormRequest
{
    /**
     * @return int
     */
    public function getRecipeId(): int
    {
        return $this->recipe_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getTypeSchedule(): string
    {
        return $this->type_schedule;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartAt(): DateTimeInterface
    {
        return $this->start_at;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndAt(): DateTimeInterface
    {
        return $this->end_at;
    }

    /**
     * @return bool
     */
    public function getAllDay(): bool
    {
        return $this->all_day;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            'recipe_id'     => 'required_if:type_schedule,recette,numeric',
            'user_id'       => 'numeric',
            'type_schedule' => 'required|in:recette,rendezvous,planning',
            'title'         => 'required|string',
            'details'       => 'string',
            'start_at'      => 'required|date_format:Y-m-d H:i:s',
            'end_at'        => 'required|date_format:Y-m-d H:i:s',
            'all_day'       => 'required|boolean'
        ];
    }
}