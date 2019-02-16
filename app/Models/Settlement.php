<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Settlement extends Model
{
    protected $fillable = ['name'];
    //public $timestamps = false;

    /*查询数据 */
    public function allData($search)
    {
        if ($search) {
            $page = self::where('name', 'like', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
            return $page->appends(['search' => $search]);
        } else {
            return self::orderBy('created_at', 'desc')->paginate(10);
        }
    }

    /*验证 并且 添加数据*/
    public function addData($data)
    {
        $SettlementValidate = new \App\Http\Requests\Settlement();
        $validator = Validator::make($data, $SettlementValidate->rules(), $SettlementValidate->messages());
        if ($validator->fails()) {
            return redirect('settlement/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $req = self::create($data);
            return redirect('/settlement')->with('success', '数据添加成功');
        }
    }

    /*验证 并且 修改数据*/
    public function updateData($data, $settlement)
    {
        $SettlementValidate = new \App\Http\Requests\Settlement();
        $validator = Validator::make($data, $SettlementValidate->rules(), $SettlementValidate->messages());
        if ($validator->fails()) {
            return redirect('/settlement/' . $data['id'] . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $req = $settlement->update($data);
            return redirect('/settlement')->with('success', '数据修改成功');
        }
    }


    /* 验证字段唯一性*/
    public function checkUnique($checkData)
    {
        if ($checkData['id'] == 'undefined') {
            $data['name'] = $checkData['name'];
            $rules = [
                'name' => 'unique:settlements'
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
            if ($settlement['name'] == $checkData['name']) {
                return 'true';
            } else {
                $data['name'] = $checkData['name'];
                $rules = [
                    'name' => 'unique:settlements'
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
