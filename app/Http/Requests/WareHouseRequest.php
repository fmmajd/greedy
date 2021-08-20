<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => 'required|file|mimes:json',
            'articles' => 'required|file|mimes:json',
        ];
    }
}
