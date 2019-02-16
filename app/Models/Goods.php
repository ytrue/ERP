<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Goods extends Model
{
    protected $fillable = [
        'name',
        'number',
        'bar_code',
        'specification',
        'type',
        'minimum',
        'maxnum',
        'measurement',
        'predicted_price',
        'retail_price',
        'wholesale_price',
        'vip_price',
        'discount_one',
        'discount_two',
        'current_inventory',
        'status'
    ];

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

    /* 验证 并且 添加数据*/
    public function addData($data)
    {
        $GoodsValidate = new \App\Http\Requests\Goods();
        $validator = Validator::make($data, $GoodsValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $data['status'] = 1;
            self::create($data);
            return 'true';
        }
    }

    public function updateData($data, $id)
    {
        $GoodsValidate = new \App\Http\Requests\Goods();
        $validator = Validator::make($data, $GoodsValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            if (self::where('id', $id)->update($data)) {
                return 'true';
            }
        }
    }

    /* 验证name and number字段唯一性*/
    public function checkUnique($checkData, $field)
    {
        if ($checkData['id'] == 'undefined') {
            $data[$field] = $checkData[$field];
            $rules = [
                $field => "unique:goods"
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
                    $field => "unique:goods"
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
