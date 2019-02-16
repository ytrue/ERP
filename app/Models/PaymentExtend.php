<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentExtend extends Model
{
    public $timestamps = false;

    public $table = 'payment_extends';

    protected $fillable = [
        'payment_id',
        'settlement_account',
        'payment_amount',
        'payment_type',
        'order_id',
        'unpaid_amount'
    ];


    /**
     *  Relation Purchase Model
     */
    public function getOrder()
    {
        return $this->belongsTo(\App\Models\Purchase::class, 'order_id', 'id');
    }

    /**
     *  Relation PurchaseReturn Model
     */
    public function getOrderReturn()
    {
        return $this->belongsTo(\App\Models\Purchasereturn::class, 'order_id', 'id');
    }

    /**
     *  Relation Sales Model
     */
    public function getSales()
    {
        return $this->belongsTo(\App\Models\Sales::class, 'order_id', 'id');
    }

    /**
     *  Relation SalesReturn Model
     */
    public function getSalesReturn()
    {
        return $this->belongsTo(\App\Models\Salereturn::class, 'order_id', 'id');
    }


    /**
     *  Relation Settlement Model
     */
    public function getSettlement()
    {
        return $this->belongsTo(\App\Models\Settlement::class, 'payment_type', 'id');
    }

    /**
     *  Relation Account Model
     */
    public function getAccount()
    {
        return $this->belongsTo(\App\Models\Account::class, 'settlement_account', 'id');
    }

    /**
     *  Relation Purchase Model
     */
    public function getPayment()
    {
        return $this->belongsTo(\App\Models\Payment::class, 'payment_id', 'id');
    }


}
