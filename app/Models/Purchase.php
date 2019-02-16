<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Validator;

class Purchase extends Model
{
    protected $fillable = [
        'document_number',
        'supplier_name',
        'supplier_id',
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
                'supplierManagement' => [
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
                ->where('supplier_id', $newGetData['supplierManagement']['where'], $newGetData['supplierManagement']['value'])
                ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
                ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
                ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
                ->paginate(10);

            return $page->appends([
                'start_date' => $newGetData['start_date']['value'],
                'end_date' => $newGetData['end_date']['value'],
                'supplierManagement' => $newGetData['supplierManagement']['value'],
                'status' => $newGetData['status']['value'],
                'document_number' => $newGetData['document_number']['value'],
            ]);
    }


    /* status filed修改器*/
    public function getStatusAttribute($value)
    {
        return StorehouseUpdateStatus($value, '已入库', '未入库');
    }

    /*验证并且添加数据*/
    public function addData($data, $dataExtend)
    {
        $data['document_number'] = 'CG' . date('YmdHis');
        $data['user_name'] = \Auth::user()->name;
        $data['user_id'] = \Auth::id();
        $purchaseValidate = new \App\Http\Requests\Purchase();
        $validator = Validator::make($data, $purchaseValidate->rules());
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            DB::beginTransaction();
            try {
                $purchase = self::create($data);
                DB::table('accounts')->where('id', $purchase->settlement_account)->decrement('current_balance',$purchase->paid);
                $sum = 0;
                foreach ($dataExtend['data'] as $key => $value) {
                    $json_data = json_decode($value);
                    PurchaseExtend::create([
                        'purchase_id' => $purchase->id,
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
                }
                if ($purchase->preferential_rate == 0){
                    $sum = $sum;
                }else{
                    $preferential_rate = ($purchase->preferential_rate/100);
                    $sum = $sum*$preferential_rate;
                }
                DB::table('purchases')->where('id', $purchase->id)->increment('total_amount',
                    $sum);

                DB::commit();
                return 'true';
            } catch (\Exception $exception) {
                return DB::rollBack();
            }
        }
    }


    //关联附表
    public function getPurchaseExtend()
    {
        return $this->hasMany(\App\Models\PurchaseExtend::class, 'purchase_id', 'id');
    }

    //获得商品供应商
    public function getSupplierManagement()
    {
        return $this->belongsTo('\App\Models\Suppliermanagement', 'supplier_id', 'id');
    }

    public function getAccount()
    {
        return $this->belongsTo('\App\Models\Account', 'settlement_account', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
