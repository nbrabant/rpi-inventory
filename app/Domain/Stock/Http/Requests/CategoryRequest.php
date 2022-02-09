<?php

namespace App\Domain\Stock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int category
 * @property string name
 * @property int position
 */
class CategoryRequest extends FormRequest
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' 		=> 'required|string|unique:categories,name,' . $this->category,
            'position' 	=> 'required|integer',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}