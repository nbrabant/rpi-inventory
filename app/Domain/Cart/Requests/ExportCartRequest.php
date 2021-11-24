<?php

namespace App\Domain\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportCartRequest extends FormRequest
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
            'exportType' => ['in:export,cleanexport']
        ];
    }
}