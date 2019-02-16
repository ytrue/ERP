<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Suppliermanagement extends Model
{
    protected $fillable = [
        'number',
        'name',
        'type',
        'balance_date',
        'initial_payable',
        'initial_advance_payment',
        'rate',
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
                ->orWhere('type', 'like', "%$search%")
                ->orderBy('status')
                ->orderBy('created_at', 'desc')->Paginate($perPage = 10);
            return $page->appends(['search' => $search]);
        } else {
            return self::orderBy('status')->orderBy('created_at', 'desc')->Paginate($perPage = 10);
        }
    }


    /*验证 并且 添加数据*/
    public function addData($data)
    {
        DB::beginTransaction();
        try {
            $supplierManagementValidate = new \App\Http\Requests\Suppliermanagement();
            $validator = Validator::make($data, $supplierManagementValidate->rules());
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $supplierManagement = self::create($data);
                SuppliermanagementExtend::create([
                    's_id' => $supplierManagement->id,
                    'contacts' => $data['contacts'],
                    'phone' => $data['phone'],
                    'landline' => $data['landline'],
                    'qq' => $data['qq'],
                    'address' => $data['address']
                ]);
                DB::commit();
                return 'true';
            }
        } catch (\Exception $exception) {
            return DB::rollBack();
        }
    }

    /*验证 并且 修改数据*/
    public function updateData($data, $dataOnly, $suppliermanagement)
    {
        $supplierManagementValidate = new \App\Http\Requests\Suppliermanagement();
        $validator = Validator::make($data, $supplierManagementValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            DB::beginTransaction();
            try {
                $suppliermanagement->update($data);
                $suppliermanagement->getSupplierManagementExtend()->update($dataOnly);
                DB::commit();
                return 'true';
            } catch (\Exception $exception) {
                return DB::rollBack();
            }
        }
    }

    /* 验证name and number字段唯一性*/
    public function checkUnique($checkData, $field)
    {
        if ($checkData['id'] == 'undefined') {
            $data[$field] = $checkData[$field];
            $rules = [
                $field => "unique:suppliermanagements"
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
                    $field => "unique:suppliermanagements"
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

    public function getSupplierManagementExtend()
    {
        return $this->hasOne(\App\Models\SuppliermanagementExtend::class, 's_id', 'id');
    }
}
