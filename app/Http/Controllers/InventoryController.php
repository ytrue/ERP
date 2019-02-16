<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Warehouse;
use App\Models\WarehouseGoodsNumber;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index inventory'])->only(['index']);
    }

    public function index()
    {
        $warehouseType = \request()->get('type');
        if (empty($warehouseType) || $warehouseType == 'all') {
            $data = $this->getAllData();
        } else {
            $data = $this->getAllData($warehouseType);
        }
        $warehouse = Warehouse::get();
        return view('inventory.index', ['warehouse' => $warehouse, 'model' => $data]);
    }


    private function getAllData($type = null)
    {
        if ($type) {
            $test = WarehouseGoodsNumber::where('warehouse_id', $type)->get(['goods_id', 'number'])->toArray();
            $tmp_name = Warehouse::find($type);
            $warehouse_name = $tmp_name->name;
            $type = $type;
        } else {
            $test = WarehouseGoodsNumber::get(['goods_id', 'number'])->toArray();
            $warehouse_name = '所有仓库';
            $type = 'all';
        }
        $goodsArray = [];

        for ($i = 0; $i < sizeof($test); $i++) {
            for ($j = 0; $j < sizeof($test); $j++) {
                if ($i != $j) {
                    if ($test[$i]['goods_id'] == $test[$j]['goods_id']) {
                        $test[$i]['number'] = $test[$i]['number'] + $test[$j]['number'];
                    }
                }
            }

            $key = 'goods_id';

            $yang = assoc_unique($test, $key);


            foreach ($yang as $key => $value) {
                $goodsArray[$key] = $value['goods_id'];
            }

            $goods = Goods::whereIn('id', $goodsArray)->select([
                'id',
                'name',
                'number',
                'type',
                'predicted_price',
                'specification',
                'measurement'
            ])->paginate(10);

            foreach ($goods as $k => $v) {
                $goods[$k]['number_count'] = $test[$k]['number'];
                $goods[$k]['warehouse_name'] = $warehouse_name;
            }

            $goods->appends(['type' => $type]);
            return $goods;
        }

    }

    public function excel()
    {
        \Excel::create('仓库盘点表' . date('YmdHis'), function ($excel) {
            $excel->sheet('仓库盘点表', function ($sheet) {
                $url = url()->previous();
                $getData = getUrlKeyValue($url);
                $warehouseType = $getData['type'];

                if (empty($warehouseType) || $warehouseType == 'all') {
                    $data = $this->getAllData();
                } else {
                    $data = $this->getAllData($warehouseType);
                }

                $newData = [];

                foreach ($data as $key => $value){
                    $newData[$key]['warehouseName'] = $value->warehouse_name;
                    $newData[$key]['number'] = $value->number;
                    $newData[$key]['name'] = $value->name;
                    $newData[$key]['specification'] = $value->specification;
                    $newData[$key]['measurement'] = $value->measurement;
                    $newData[$key]['number_count'] = $value->number_count;
                    $newData[$key]['sum'] = $value->number_count * $value->predicted_price;
                }

                $haha = array(
                    array('仓库盘点表'),
                    array(
                        '仓库',
                        '商品编号',
                        '商品名称',
                        '规格型号',
                        '单位',
                        '系统库存',
                        '库存金额',
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('仓库盘点表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:G2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G'),
                    'rows' => array(
                        array(3, 4),
                    )
                ));

                //设置宽度
                $sheet->setWidth(array(
                    'A' => 20,
                    'B' => 20,
                    'C' => 20,
                    'D' => 20,
                    'E' => 20,
                    'F' => 20,
                    'G' => 20,
                ));

                //设置这个范围的值字体样式
                $sheet->setBorder("A1:G$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:G$i", function ($cells) {
                        $cells->setFontSize(10);//字体大小
                        $cells->setValignment('center');//字体垂直居中
                        $cells->setAlignment('center');//字体水平居中
                        $cells->setBorder('thin', 'thin', 'thin', 'thin');//设置表格边框
                    });
                }


            })->export('xls');
        });

    }
}
