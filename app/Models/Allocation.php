<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Allocation extends Model
{
    protected $fillable = [
        'ood_number',
        'user_id',
        'user_name',
        'details'
    ];

    public function addData($data)
    {
        DB::beginTransaction();
        try {
            $allocation = self::create([
                'details' => $data['details'],
                'user_id' => \Auth::id(),
                'user_name' => \Auth::user()->name,
                'ood_number' => 'DB' . date('YmdHis'),
            ]);

            foreach ($data['data'] as $key => $value) {
                $json_data = json_decode($value);
                $allocationExtend = AllocationExtend::create([
                    'allocation_id' => $allocation->id,
                    'out_warehouse' => $json_data->out_warehouse,
                    'in_warehouse' => $json_data->in_warehouse,
                    'goods_id' => $json_data->goods_id,
                    'number' => $json_data->number,
                    'company' => $json_data->company
                ]);

                $warehouseGoodsNumber = WarehouseGoodsNumber::where('warehouse_id', $allocationExtend->in_warehouse)
                    ->where('goods_id', $allocationExtend->goods_id)
                    ->get(['goods_id']);

                $newArray = [];

                foreach ($warehouseGoodsNumber->toArray() as $k => $v) {
                    $newArray[$k] = $v['goods_id'];
                }

                $goods_id = [$allocationExtend->goods_id];
                $diff = sizeof(array_diff($goods_id, $newArray));
                if ($diff) {
                    //不等于0的话就新增
                    WarehouseGoodsNumber::create([
                        'warehouse_id' => $allocationExtend->in_warehouse,
                        'goods_id' => $allocationExtend->goods_id,
                        'number' => $allocationExtend->number
                    ]);

                    DB::table('warehouse_goods_number')
                        ->where('warehouse_id', $allocationExtend->out_warehouse)
                        ->where('goods_id', $allocationExtend->goods_id)
                        ->decrement('number', $allocationExtend->number);
                } else {
                    //等于0就修改
                    DB::table('warehouse_goods_number')
                        ->where('warehouse_id', $allocationExtend->in_warehouse)
                        ->where('goods_id', $allocationExtend->goods_id)
                        ->increment('number', $allocationExtend->number);

                    DB::table('warehouse_goods_number')
                        ->where('warehouse_id', $allocationExtend->out_warehouse)
                        ->where('goods_id', $allocationExtend->goods_id)
                        ->decrement('number', $allocationExtend->number);

                }
            }
            DB::commit();
            return 'true';
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function getAllocationExtend()
    {
        return $this->hasMany(\App\Models\AllocationExtend::class, 'allocation_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

}
