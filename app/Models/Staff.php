<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Staff extends Model
{
    public $table = 'staffs';
    protected $fillable = ['name', 'number', 'status'];

    /* status filed修改器*/
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 1:
                return '<span class="label label-primary">已启动</span>';
            case 2:
                return '<span class="label label-danger">已禁用</span>';
        }
    }


    /*查询数据*/
    public function allData($search)
    {
        if ($search) {
            $page = self::where('name', 'like', "%$search%")
                ->orWhere('number', 'like', "%$search%")
                ->orderBy('status')
                ->orderBy('created_at', 'desc')->paginate(10);
            return $page->appends(['search' => $search]);
        } else {
            return self::orderBy('status')->orderBy('created_at', 'desc')->paginate(10);
        }
    }

    /*验证并且添加数据*/
    public function addData($data)
    {
        $StaffValidate = new \App\Http\Requests\Staff();
        $validator = Validator::make($data, $StaffValidate->rules(), $StaffValidate->messages());
        if ($validator->fails()) {
            return redirect('staff/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data['status'] = 1;
            self::create($data);
            return redirect('/staff')->with('success', '数据添加成功');
        }
    }

    /*验证并且 修改数据*/
    public function updateData($data, $staff)
    {
        $StaffValidate = new \App\Http\Requests\Staff();
        $validator = Validator::make($data, $StaffValidate->rules(), $StaffValidate->messages());
        if ($validator->fails()) {
            return redirect('staff/' . $data['id'] . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $staff->update($data);
            return redirect('/staff')->with('success', '数据修改成功');
        }
    }

    /* 验证name and number字段唯一性*/
    public function checkUnique($checkData, $field)
    {
        if ($checkData['id'] == 'undefined') {
            $data[$field] = $checkData[$field];
            $rules = [
                $field => "unique:staffs"
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
                    $field => "unique:staffs"
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
