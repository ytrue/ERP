<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Salereturn;
use App\Models\Purchasereturn;
use App\Models\Staff;
use App\Models\WarehouseGoodsNumber;
use App\Models\Suppliermanagement;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class StorehouseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index getSaleReturn'])->only(['getSaleReturn']);
        $this->middleware(['permission:status getSaleReturn'])->only(['saleReturnStatus']);

        $this->middleware(['permission:index getSales'])->only(['getSales']);
        $this->middleware(['permission:status getSales'])->only(['salesStatus']);

        $this->middleware(['permission:index getPurchaseReturn'])->only(['getPurchaseReturn']);
        $this->middleware(['permission:status getPurchaseReturn'])->only(['purchaseReturnStatus']);

        $this->middleware(['permission:index getPurchase'])->only(['getPurchase']);
        $this->middleware(['permission:status getPurchase'])->only(['purchaseStatus']);

    }
    //购货
    public function getPurchase()
    {
        $supplierManagement = Suppliermanagement::where('status', 1)->get();  //where =1
        $purchase = new Purchase();
        return view('storehouse.getPurchase', [
            'model' => $purchase->allData(\request()->all()),
            'supplierManagement' => $supplierManagement
        ]);
    }

    //购货入库
    public function purchaseStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->post('id');
            $purchase = Purchase::find($id);
            if ($purchase->status == '<span class="label label-danger">未入库</span>') {
                foreach ($purchase->getPurchaseExtend as $key => $value) {
                    DB::table('goods')
                        ->where('id', $value->goods_id)
                        ->increment('current_inventory', $value->number);

                    $warehouseGoodsNumber = WarehouseGoodsNumber::where('warehouse_id', $value->warehouse_id)
                        ->where('goods_id', $value->goods_id)
                        ->get(['goods_id']);

                    $newArray = [];

                    foreach ($warehouseGoodsNumber->toArray() as $k => $v) {
                        $newArray[$k] = $v['goods_id'];
                    }

                    $goods_id = [$value->goods_id];
                    $diff = sizeof(array_diff($goods_id, $newArray));

                    if ($diff) {
                        //不等于0的话就新增
                        WarehouseGoodsNumber::create([
                            'warehouse_id' => $value->warehouse_id,
                            'goods_id' => $value->goods_id,
                            'number' => $value->number
                        ]);

                    } else {
                        //等于0就修改
                        DB::table('warehouse_goods_number')
                            ->where('warehouse_id', $value->warehouse_id)
                            ->where('goods_id', $value->goods_id)
                            ->increment('number', $value->number);

                    }
                }

                $purchase->update(['status' => 2]);
                return '2';
            } else {
                return '1';
            }
        }
    }

    //退货出库
    public function getPurchaseReturn()
    {
        $supplierManagement = Suppliermanagement::where('status', 1)->get();  //where =1
        $purchaseReturn = new Purchasereturn();
        return view('storehouse.getPurchaseReturn',
            [
            'model' => $purchaseReturn->allData(\request()->all()),
            'supplierManagement' => $supplierManagement
        ]);
    }

    //update stautus
    public function purchaseReturnStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->post('id');
            $purchaseReturn = Purchasereturn::find($id);
            if ($purchaseReturn->status == '<span class="label label-danger">未处理</span>') {
                $purchaseReturn->update(['status' => 2]);
                return '2';
            } else {
                return '1';
            }
        }
    }

    public function getSales()
    {
        $staff = Staff::where('status', 1)->get();
        $client = Client::where('status', 1)->get();
        $sales = new Sales();
        return view('storehouse.getSales', [
            'model' => $sales->allData(\request()->all()),
            'client' => $client,
            'staff' => $staff
        ]);
    }

    //update stautus
    public function salesStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->post('id');
            $sales = Sales::find($id);
            if ($sales->status == '<span class="label label-danger">未处理</span>') {
                $sales->update(['status' => 2]);
                return '2';
            } else {
                return '1';
            }
        }
    }

    //
    public function getSaleReturn()
    {
        $staff = Staff::where('status', 1)->get();
        $client = Client::where('status', 1)->get();
        $saleReturn = new Salereturn();
        return view('storehouse.getSaleReturn', [
            'model' => $saleReturn->allData(\request()->all()),
            'client' => $client,
            'staff' => $staff
        ]);
    }

    public function saleReturnStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->post('id');
            $saleReturn = Salereturn::find($id);
            if ($saleReturn->status == '<span class="label label-danger">未入库</span>') {
                foreach ($saleReturn->getSaleReturnExtend as $key => $value) {
                    DB::table('goods')
                        ->where('id', $value->goods_id)
                        ->increment('current_inventory', $value->number);

                    $warehouseGoodsNumber = WarehouseGoodsNumber::where('warehouse_id', $value->warehouse_id)
                        ->where('goods_id', $value->goods_id)
                        ->get(['goods_id']);

                    $newArray = [];
                    foreach ($warehouseGoodsNumber->toArray() as $k => $v) {
                        $newArray[$k] = $v['goods_id'];
                    }

                    $goods_id = [$value->goods_id];
                    $diff = sizeof(array_diff($goods_id, $newArray));

                    if ($diff) {
                        //不等于0的话就新增
                        WarehouseGoodsNumber::create([
                            'warehouse_id' => $value->warehouse_id,
                            'goods_id' => $value->goods_id,
                            'number' => $value->number
                        ]);

                    } else {
                        //等于0就修改
                        DB::table('warehouse_goods_number')
                            ->where('warehouse_id', $value->warehouse_id)
                            ->where('goods_id', $value->goods_id)
                            ->increment('number', $value->number);

                    }
                }
                $saleReturn->update(['status' => 2]);
                return '2';
            } else {
                return '1';
            }
        }
    }
}
