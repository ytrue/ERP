<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Supplier extends Model
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
        $SupplierValidate = new \App\Http\Requests\Supplier();
        $validator = Validator::make($data, $SupplierValidate->rules(), $SupplierValidate->messages());
        if ($validator->fails()) {
            return redirect('supplier/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            self::create($data);
            return redirect('/supplier')->with('success', '数据添加成功');
        }
    }

    /*验证 并且 修改数据*/
    public function updateData($data, $supplier)
    {
        $SupplierValidate = new \App\Http\Requests\Supplier();
        $validator = Validator::make($data, $SupplierValidate->rules(), $SupplierValidate->messages());
        if ($validator->fails()) {
            return redirect('/supplier/' . $data['id'] . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $supplier->update($data);
            return redirect('/supplier')->with('success', '数据修改成功');
        }
    }


    /* 验证字段唯一性*/
    public function checkUnique($checkData)
    {
        if ($checkData['id'] == 'undefined') {
            $data['name'] = $checkData['name'];
            $rules = [
                'name' => 'unique:suppliers'
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            $data['id'] = $checkData['id'];
            $supplier = self::find($checkData['id']);
            if ($supplier['name'] == $checkData['name']) {
                return 'true';
            } else {
                $data['name'] = $checkData['name'];
                $rules = [
                    'name' => 'unique:suppliers'
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
