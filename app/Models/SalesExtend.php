<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesExtend extends Model
{
    public $table = 'sales_extends';

    public $timestamps = false;

    protected $fillable = [
        'sales_id',
        'goods_name',
        'goods_id',
        'warehouse_id',
        'company',
        'number',
        'unit_purchase_price',
        'discount_rate',
        'purchase_amount',
        'company'
    ];

    public function getSales()
    {
        return $this->belongsTo(\App\Models\Sales::class, 'sales_id', 'id');
    }

    public function getWarehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class, 'warehouse_id', 'id');
    }

    public function getGoods()
    {
        return $this->belongsTo(\App\Models\Goods::class, 'goods_id', 'id');
    }
}
