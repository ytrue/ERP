<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{

    protected $fillable = [
        'ood_number',
        'details',
        'unit_id',
        'type',
        'user_id'
    ];

    public function allData($data, $type)
    {
        $newGetData = judgeData($data, [
            'unit' => [
                'where' => '!=',
                'value' => '',
            ],
            'document_number' => [
                'where' => '!=',
                'value' => '',
            ],
        ]);

        $documentNumber = $newGetData['document_number']['value'];

        $page = self::orderBy('created_at', 'desc')
            ->where('type', $type)
            ->where('ood_number', 'like', "%$documentNumber%")
            ->where('unit_id', $newGetData['unit']['where'], $newGetData['unit']['value'])
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->paginate(10);

        return $page->appends([
            'start_date' => $newGetData['start_date']['value'],
            'end_date' => $newGetData['end_date']['value'],
            'unit' => $newGetData['unit']['value'],
            'document_number' => $newGetData['document_number']['value'],
        ]);
    }


    /**
     * add data
     */

    public function addData($data, $type)
    {
        switch ($type){
            case 'purchasePayment':
                return $this->addPurchasePayment($data, 1 , 'GHZF', 'purchases');
                break;
            case 'purchaseReceipts':
                return $this->addPurchasePayment($data, 2 , 'GHSK', 'purchasereturns');
                break;
            case 'salesReceipts':
                return $this->addPurchasePayment($data, 3 , 'XHSK', 'sales');
                break;
            case 'salesPayment':
                return $this->addPurchasePayment($data, 4 , 'XHZF', 'salereturns');
                break;
        }
    }

    private function addPurchasePayment($data, $type, $paymentType, $table)
    {
        DB::beginTransaction();
        try{
            $data['ood_number'] = $paymentType.date('YmdHis');
            $data['user_id'] = \Auth::id();
            $data['type'] = $type;
            $payment = self::create($data);
            foreach ($data['data'] as $key => $value){
                $obj_data = json_decode($value);
                PaymentExtend::create([
                    'payment_id' => $payment->id,
                    'settlement_account' => $obj_data->account_id,
                    'payment_type' => $obj_data->settlement_id,
                    'order_id' => $obj_data->order_id,
                    'payment_amount' => $obj_data->payment_amount,
                    'unpaid_amount' => $obj_data->unpaid_amount,
                ]);
                DB::table($table)->where('id', $obj_data->order_id)->increment('paid' ,$obj_data->payment_amount);

                if ($type == 1 || $type == 4){
                    DB::table('accounts')->where('id', $obj_data->account_id)->decrement('current_balance',$obj_data->payment_amount);
                }else{
                    DB::table('accounts')->where('id', $obj_data->account_id)->increment('current_balance',$obj_data->payment_amount);
                }

            }
            DB::commit();
            return  'true';
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }

    /**
     *  Relation PaymentExtend Model
     */
    public function getPaymentExtend()
    {
        return $this->hasMany(\App\Models\PaymentExtend::class, 'payment_id' ,'id');
    }

    /**
     *  Relation SupplierManagement Model
     */
    public function getSupplierManagement()
    {
        return $this->belongsTo(\App\Models\Suppliermanagement::class, 'unit_id', 'id');
    }

    /**
     *  Relation User Model
     */

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    /**
     *  Relation client Model
     */
    public function getClient()
    {
        return $this->belongsTo(\App\Models\Client::class, 'unit_id', 'id');
    }



}
