<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:100',
            'sku' => 'max:20',
            'price' => 'numeric',
            'category' => "array"
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.max' => 'Name length cannot exceed 100 characters',
            'sku.max' => 'SKU code cannot exceed 20 characters',
            'price.numeric' => 'Price must be numeric'
        ];
    }
}
