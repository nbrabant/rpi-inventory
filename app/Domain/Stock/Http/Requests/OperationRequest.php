<?php

namespace App\Domain\Stock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int productId
 * @property int quantity
 * @property string operation
 * @property string detail
 */
class OperationRequest extends FormRequest
{
    /**
     * @return int
     */
    public function getProductId(): int {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getOperation(): string {
        return $this->operation;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'product_id'    => 'required|integer',
            'quantity'      => 'required|integer',
            'operation'     => 'required|in:+,-',
            'detail'        => 'required|string',
        ];
    }
}