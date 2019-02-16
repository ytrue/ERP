<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Client extends FormRequest
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
            'number' => 'required|max:10|min:4',
            'type' => 'required',
            'level' => 'required',
            'balance_date' => 'required',
            'initial_payable' => 'required',
            'initial_advance_payment' => 'required',
            'contacts' => 'required|max:20|min:2',
            'phone' => 'required|max:11|min:11',
            'landline' => 'required|max:11|min:11',
            'qq' => 'required|min:6|max:10',
            'address' => 'required|min:2|max:120',
            'info' => 'required|max:120|min:2'
        ];
    }
}
