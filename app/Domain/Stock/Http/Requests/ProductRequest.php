<?php

namespace App\Domain\Stock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int product
 * @property int categoryId
 * @property string name
 * @property string description
 * @property int minQuantity
 * @property string unit
 */
class ProductRequest extends FormRequest
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
            'category_id'	=> 'required|integer',
            'name' 			=> 'required|string|unique:products,name,' . $this->product,
            'description'	=> 'required|string',
            'min_quantity'	=> 'required|integer',
            'unit'			=> 'string|in:piece,grammes,litre,sachet',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getMinQuantity(): int
    {
        return $this->minQuantity;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}