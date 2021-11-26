<?php

namespace App\Domain\Schedule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
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