<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Expenditure extends Model
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
        $ExpenditureValidate = new \App\Http\Requests\Expenditure();
        $validator = Validator::make($data, $ExpenditureValidate->rules(), $ExpenditureValidate->messages());
        if ($validator->fails()) {
            return redirect('expenditure/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            self::create($data);
            return redirect('/expenditure')->with('success', '数据添加成功');
        }
    }

    /*验证 并且 修改数据*/
    public function updateData($data, $expenditure)
    {
        $ExpenditureValidate = new \App\Http\Requests\Expenditure();
        $validator = Validator::make($data, $ExpenditureValidate->rules(), $ExpenditureValidate->messages());
        if ($validator->fails()) {
            return redirect('/expenditure/' . $data['id'] . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $expenditure->update($data);
            return redirect('/expenditure')->with('success', '数据修改成功');
        }
    }


    /* 验证字段唯一性*/
    public function checkUnique($checkData)
    {
        if ($checkData['id'] == 'undefined') {
            $data['name'] = $checkData['name'];
            $rules = [
                'name' => 'unique:expenditures'
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            $data['id'] = $checkData['id'];
            $expenditure = self::find($checkData['id']);
            if ($expenditure['name'] == $checkData['name']) {
                return 'true';
            } else {
                $data['name'] = $checkData['name'];
                $rules = [
                    'name' => 'unique:expenditures'
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
