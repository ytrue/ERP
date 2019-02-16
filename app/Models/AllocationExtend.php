<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllocationExtend extends Model
{
    public $timestamps = false;

    public $table = 'allocation_extends';

    protected $fillable = [
        'allocation_id',
        'out_warehouse',
        'in_warehouse',
        'goods_id',
        'number',
        'company'
    ];

    public function getOutWarehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class, 'out_warehouse', 'id');
    }

    public function getInWarehouse()
    {
        return $this->belongsTo(\App\Models\Warehouse::class, 'in_warehouse', 'id');
    }

    public function getGoods()
    {
        return $this->belongsTo(\App\Models\Goods::class, 'goods_id', 'id');
    }

    public function getAllocation()
    {
        return $this->belongsTo(\App\Models\Allocation::class, 'allocation_id', 'id');
    }


}
