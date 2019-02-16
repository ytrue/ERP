<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
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
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation'=>['required',"same:password"//不为空,两次密码是否相同
            ],
            'phone'=>'required|regex:/^1[34578][0-9]{9}$/|unique:users',
            'real_name' => 'required|min:2',

        ];
    }

}
