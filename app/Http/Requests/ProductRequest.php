<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'image'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'price'=>'nullable',
            'discounted_price'=>'nullable',
            'discount_percent'=>'nullable',
            'category_id'=>'required',
        ];
    }
}
