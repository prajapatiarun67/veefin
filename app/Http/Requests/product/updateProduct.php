<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class updateProduct extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'name' => ['required','string','max:255'],
            'product_code' => [ 
                    'required', 
                    'string',
                    'max:50',
                    Rule::unique('product', 'product_code')->ignore($this->product, 'id')
                ],
            'description' => ['required','string'],
            'price' => ['required','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'discount_price' => ['required','numeric','min:0','lte:price'],
            'is_active' => ['boolean'],
        ];
    }
}
