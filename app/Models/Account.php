<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Account extends Model
{

    protected $fillable = ['number', 'name', 'balance', 'balance_date', 'type', 'current_balance'];

    //获取器
    public function getTypeAttribute($value)
    {
        switch ($value) {
            case 1:
                return '现金';
            case 2:
                return '银行存款';
        }
    }

    /*查询数据 */
    public function allData($search)
    {
        if ($search) {
            $page = self::where('name', 'like', "%$search%")
                ->orWhere('number', 'like', "%$search%")
                ->orderBy('created_at', 'desc')->Paginate($perPage = 10);
            return $page->appends(['search' => $search]);
        } else {
            return self::orderBy('created_at', 'desc')->Paginate($perPage = 10);
        }
    }


    /*验证并且添加数据*/
    public function addData($data)
    {
        $AccountValidate = new \App\Http\Requests\Account();
        $validator = Validator::make($data, $AccountValidate->rules(), $AccountValidate->messages());
        if ($validator->fails()) {
            return redirect('/account/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data['current_balance'] = $data['balance'];
            self::create($data);
            return redirect('/account')->with('success', '数据添加成功');

        }
    }

    /*验证并且修改数据*/
    public function updateData($data, $account)
    {
        $AccountValidate = new \App\Http\Requests\Account();
        $validator = Validator::make($data, $AccountValidate->rules(), $AccountValidate->messages());
        if ($validator->fails()) {
            return redirect('/account/' . $data['id'] . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $account->update($data);
            return redirect('/account')->with('success', '数据修改成功');
        }
    }

    /* 验证name and number字段唯一性*/
    public function checkUnique($checkData, $field)
    {
        if ($checkData['id'] == 'undefined') {
            $data[$field] = $checkData[$field];
            $rules = [
                $field => "unique:accounts"
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            $data['id'] = $checkData['id'];
            $settlement = self::find($checkData['id']);
            if ($settlement[$field] == $checkData[$field]) {
                return 'true';
            } else {
                $data[$field] = $checkData[$field];
                $rules = [
                    $field => "unique:accounts"
                ];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    echo 'false';
                } else {
                    echo 'true';
                }
            }

        }
    }
}
