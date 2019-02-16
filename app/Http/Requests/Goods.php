<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Goods extends FormRequest
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
            'name' => "required|max:20|min:2",
            'number' => 'required|max:10|min:4',
            'bar_code' => 'required|max:20',
            'specification' => 'required|max:20',
            'type' => 'required|max:10',
            'minimum' => 'required|max:10',
            'maxnum' => 'required|max:10',
            'measurement' => 'required|max:10',
            'predicted_price' => 'required',
            'retail_price' => 'required',
            'wholesale_price' => 'required',
            'vip_price' => 'required',
            'discount_one' => 'required',
            'discount_two' => 'required',
//                'goods_id' => 'required|max:10',
//                'warehouse_id' => 'required|max:10',
//                'Initial_quantity' =>'required',
//                'unit_cost' => 'required'
        ];
    }
}
