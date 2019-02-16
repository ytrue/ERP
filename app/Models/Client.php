<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $fillable = [
        'name',
        'number',
        'type',
        'level',
        'balance_date',
        'initial_payable',
        'initial_advance_payment',
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
                ->orderBy('created_at', 'desc')->paginate(10);
            return $page->appends(['search' => $search]);
        } else {
            return self::orderBy('status')->orderBy('created_at', 'desc')->paginate(10);
        }
    }


    /*验证 并且 添加数据*/
    public function addData($data)
    {
        $clientValidate = new \App\Http\Requests\Client();
        $validator = Validator::make($data, $clientValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            DB::beginTransaction();
            try {
                $client = self::create($data);
                ClientExtend::create([
                    'c_id' => $client->id,
                    'contacts' => $data['contacts'],
                    'phone' => $data['phone'],
                    'landline' => $data['landline'],
                    'qq' => $data['qq'],
                    'address' => $data['address'],
                    'info' => $data['info']
                ]);
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
                $field => "unique:clients"
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
                    $field => "unique:clients"
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


    public function getClientExtend()
    {
        return $this->hasOne(\App\Models\ClientExtend::class, 'c_id', 'id');
    }
}
