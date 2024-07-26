<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_value'=>'required',
            'en_value'=>'required',
            'ru_value'=>'required',
            'map'=>'required',
        ];
    }
}
