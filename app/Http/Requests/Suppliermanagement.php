<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Suppliermanagement extends FormRequest
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
            'number' => 'required|max:10|min:4',
            'name' => 'required|max:20|min:2',
            'type' => 'required',
            'balance_date' => 'required',
            'initial_payable' => 'required',
            'initial_advance_payment' => 'required',
            'rate' => 'required',
            'contacts' => 'required',
            'phone' => 'required|max:11|min:11',
            'landline' => 'required|max:11|min:11',
            'qq' => 'required|max:10|min:10',
            'address' => 'required|max:225'
        ];
    }
}
