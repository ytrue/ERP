<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseGoodsNumber extends Model
{
    public $table = 'warehouse_goods_number';
    public $timestamps = false;
    protected $fillable = [
        'supplier_management_id',
        'warehouse_id',
        'goods_id',
        'number'
    ];

    public function getSupplierManagement()
    {
        return $this->belongsTo(\App\Models\Suppliermanagement::class, 'supplier_management_id', 'id');
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
