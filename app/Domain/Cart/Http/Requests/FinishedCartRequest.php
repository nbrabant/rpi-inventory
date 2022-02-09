<?php

namespace App\Domain\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property bool finished
 */
class FinishedCartRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function getFinished(): bool
    {
        return $this->finished;
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
            'finished' => 'boolean'
        ];
    }
}