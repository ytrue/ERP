<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Sales extends Model
{
    public $table = 'sales';

    protected $fillable = [
        'staff_name',
        'staff_id',
        'document_number',
        'client_name',
        'client_id',
        'preferential_rate',
        'paid',
        'settlement_account',
        'details',
        'user_name',
        'user_id',
        'status',
        'total_amount'
    ];

    /*获得数据*/
    public function allData($data = null)
    {
        $newGetData = judgeData($data, [
            'client' => [
                'where' => '!=',
                'value' => '',
            ],
            'staff' => [
                'where' => '!=',
                'value' => '',
            ],
            'document_number' => [
                'where' => '!=',
                'value' => '',
            ],
            'status' => [
                'where' => '!=',
                'value' => '',
            ],
        ]);
        $documentNumber = $newGetData['document_number']['value'];
        $page = self::orderBy('status')
            ->orderBy('created_at', 'desc')
            ->where('document_number', 'like', "%$documentNumber%")
            ->where('client_id', $newGetData['client']['where'], $newGetData['client']['value'])
            ->where('staff_id', $newGetData['staff']['where'], $newGetData['staff']['value'])
            ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->paginate(10);

        return $page->appends([
            'start_date' => $newGetData['start_date']['value'],
            'end_date' => $newGetData['end_date']['value'],
            'client' => $newGetData['client']['value'],
            'staff' => $newGetData['staff']['value'],
            'status' => $newGetData['status']['value'],
            'document_number' => $newGetData['document_number']['value'],
        ]);

    }


    /* status filed修改器*/
    public function getStatusAttribute($value)
    {
        return StorehouseUpdateStatus($value, '已出库', '未处理');
    }


    /*验证并且添加数据*/
    public function addData($data, $dataExtend)
    {
        $data['document_number'] = 'XH' . date('YmdHis');
        $data['user_name'] = \Auth::user()->name;
        $data['user_id'] = \Auth::id();
        $salesValidate = new \App\Http\Requests\Sales();
        $validator = Validator::make($data, $salesValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            DB::beginTransaction();
            try {
                $sales = self::create($data);
                DB::table('accounts')->where('id', $sales->settlement_account)->increment('current_balance',$sales->paid);
                $sum = 0;
                foreach ($dataExtend['data'] as $key => $value) {
                    $json_data = json_decode($value);
                    $salesExtend = SalesExtend::create([
                        'sales_id' => $sales->id,
                        'goods_name' => $json_data->goods_name,
                        'goods_id' => $json_data->goods_id,
                        'warehouse_id' => $json_data->warehouse_id,
                        'company' => $json_data->company,
                        'number' => $json_data->number,
                        'unit_purchase_price' => $json_data->unit_purchase_price,
                        'discount_rate' => $json_data->discount_rate,
                        'purchase_amount' => $json_data->purchase_amount
                    ]);

                    $sum+=$json_data->purchase_amount;

                    DB::table('goods')->where('id', $salesExtend->goods_id)->decrement('current_inventory',
                        $salesExtend->number);
                    DB::table('warehouse_goods_number')
                        ->where('warehouse_id', $salesExtend->warehouse_id)
                        ->where('goods_id', $salesExtend->goods_id)
                        ->decrement('number', $salesExtend->number);
                }

                if ($sales->preferential_rate == 0){
                    $sum = $sum;
                }else{
                    $preferential_rate = ($sales->preferential_rate/100);
                    $sum = $sum*$preferential_rate;
                }

                DB::table('sales')->where('id', $sales->id)->increment('total_amount', $sum);

                DB::commit();
                return ' true';
            } catch (\Exception $exception) {
                return DB::rollBack();
            }
        }
    }


    public function getSalesExtend()
    {
        return $this->hasMany(\App\Models\SalesExtend::class, 'sales_id', 'id');
    }

    /*获得客户数据*/
    public function getClient()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id', 'id');
    }

    public function getAccount()
    {
        return $this->belongsTo('\App\Models\Account', 'settlement_account', 'id');
    }

    public function getStaff()
    {
        return $this->belongsTo(\App\Models\Staff::class, 'staff_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
