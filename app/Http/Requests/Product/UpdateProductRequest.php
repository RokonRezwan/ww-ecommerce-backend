<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'in:0,1',
        ];
    }
}
