<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Salereturn extends FormRequest
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
            'document_number' => 'required',
            'client_name' => 'required',
            'client_id' => 'required',
            'settlement_account' => 'required',
        ];
    }
}
