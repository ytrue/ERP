<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemParameter extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20|min:2',
            'address' => 'required|max:120|min:2',
            'phone' => 'required|max:11|min:11',
            'fax' => 'required',
            'zip_code' => 'required',
            'standard_currency' => 'required',
            'inventory_valuation_method' => 'required',
        ];
    }
}
