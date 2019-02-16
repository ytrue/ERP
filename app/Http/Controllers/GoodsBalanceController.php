<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\WarehouseGoodsNumber;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GoodsBalanceController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index goodsBalance']);
    }

    public function index(Request $request)
    {
        $warehouse = Warehouse::where('status', 1)->get();
        $goods = Goods::where('status', 1)->get();
        $newArray = $this->getData($warehouse, $request);

        return view('goodsBalance.index', [
            'warehouse' => $warehouse,
            'goods' => $goods,
            'model' => $newArray
        ]);
    }


    /**
     * 自定义数组分页
     *
     * @access public
     * @param object $request
     * @return object
     */
    public function getData($warehouse, $request)
    {
        $getData = $request->all();
        $newGetData = $this->judgeData($getData);

        $data = $this->sqlData($warehouse, $request->all());

        //当前页数 默认1
        $page = $request->page ?: 1;
        //每页的条数
        $perPage = 10;
        //计算每页分页的初始位置
        $offset = ($page * $perPage) - $perPage;
        //实例化LengthAwarePaginator类，并传入对应的参数
        $data = new LengthAwarePaginator(array_slice($data, $offset, $perPage, true), count($data), $perPage,
            $page, ['path' => $request->url(), 'query' => $request->query()]);

        $data->appends([
            'goods' => $newGetData['goods']['value'],
            'warehouse' => $newGetData['warehouse']['value'],
        ]);

        return $data;

    }


    /**
     * @param object $warehouse
     * @param object $getData
     * @return  array
     */
    public function sqlData($warehouse, $getData)
    {
        $newArray = [];
        $newGetData = $this->judgeData($getData);

        $goods = WarehouseGoodsNumber::groupBy('goods_id')
            ->where('goods_id', $newGetData['goods']['where'], $newGetData['goods']['value'])
            ->where('warehouse_id', $newGetData['warehouse']['where'], $newGetData['warehouse']['value'])
            ->get(['goods_id']);  //商品的id


        foreach ($goods as $key => $value) {
            $newArray[$key]['goodsNumber'] = $value->getGoods->number;
            $newArray[$key]['goodsName'] = $value->getGoods->name;
            $newArray[$key]['goodsSpecification'] = $value->getGoods->specification;
            $newArray[$key]['measurement'] = $value->getGoods->measurement;
            $newArray[$key]['goodsSum'] = WarehouseGoodsNumber::where('goods_id', $value->goods_id)->sum('number');
            $newArray[$key]['goodsCost'] = sprintf("%.2f", ($newArray[$key]['goodsSum'] * $value->getGoods->predicted_price));
            $newArray[$key]['warehouses'] = WarehouseGoodsNumber::where('goods_id', $value->goods_id)->get(['warehouse_id', 'number'])->toArray();

            foreach ($newArray[$key]['warehouses'] as $k => $v) {
                $newArray[$key]['warehouseIdArray'][$v['warehouse_id']] = $v['number'];
            }

            foreach ($warehouse as $kk => $vv) {

                if (array_key_exists($vv->id, $newArray[$key]['warehouseIdArray'])) {
                    $newArray[$key]['warehouse' . $vv->id] = $newArray[$key]['warehouseIdArray'][$vv->id];
                } else {
                    $newArray[$key]['warehouse' . $vv->id] = 0;
                }
            }
        }

        return $newArray;
    }

    /**
     * 判断url的get传参是否为空，为空则做出一些动作
     *
     * @access private
     * @param  array $getData
     * @return array
     */
    private function judgeData($getData)
    {
        $newGetData = [];
        if (!empty($getData)) {
            foreach ($getData as $key => $value) {
                if (empty($value)) {
                    $newGetData[$key]['where'] = '!=';
                    $newGetData[$key]['value'] = '';
                } else {
                    $newGetData[$key]['where'] = '=';
                    $newGetData[$key]['value'] = $value;
                }
            }
        } else {
            $newGetData = [
                'goods' => [
                    'where' => '!=',
                    'value' => '',
                ],
                'warehouse' => [
                    'where' => '!=',
                    'value' => '',
                ],
            ];
        }
        return $newGetData;
    }

    /**
     * 导出excel表格
     *
     * @return void
     */
    public function excel()
    {

        \Excel::create('商品库存余额表' . date('YmdHis'), function ($excel) {
            $excel->sheet('商品库存余额表', function ($sheet) {

                $warehouse = Warehouse::where('status', 1)->get();
                $url = url()->previous();
                $newData = $this->sqlData($warehouse, getUrlKeyValue($url));
                //

                $newDataA = [];
                foreach ($newData as $key => $value) {
                    $newDataA[$key]['goodsNumber'] = $value['goodsNumber'];
                    $newDataA[$key]['goodsName'] = $value['goodsName'];
                    $newDataA[$key]['goodsSpecification'] = $value['goodsSpecification'];
                    $newDataA[$key]['measurement'] = $value['measurement'];
                    $newDataA[$key]['goodsSum'] = $value['goodsSum'];
                    $newDataA[$key]['goodsCost'] = $value['goodsCost'];
                    foreach ($warehouse as $k => $v) {
                        $newDataA[$key]['warehouse' . $v->id] = $value['warehouse' . $v->id];
                    }
                }


                $ROW = range('A', 'Z');
                $warehouseCount = Warehouse::where('status', 1)->count();  //7  F == 6-1
                $endRow = $ROW[$warehouseCount + 5];


                //value
                $valueA = ['商品编号', '商品名称', '规格型号', '单位', '所有仓库', '所有仓库'];
                $newValueA = [];
                foreach ($warehouse as $key => $value) {
                    $newValueA[$key] = $value->name;
                }

                $valueB = ['商品编号', '商品名称', '规格型号', '单位', '成本', '数量'];
                $newValueB = [];
                foreach ($warehouse as $key => $value) {
                    $newValueB[$key] = '数量';
                }

                $haha = array(
                    ['商品库存余额表'],
                    array_merge($valueA, $newValueA),
                    array_merge($valueB, $newValueB),

                );
                $zz = array_merge($haha, $newDataA);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);

                //A1的值
                $sheet->row(1, array(
                    ('商品库存余额表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:' . $endRow . '2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D'),
                    'rows' => array(
                        array(3, 4),
                    )
                ));
                $sheet->mergeCells('E3:F3');

                //设置宽度
                $row = array(
                    'A' => 20,
                    'B' => 20,
                    'C' => 20,
                    'D' => 20,
                    'E' => 20,
                    'F' => 20,
                );
                $setRow = [];
                for ($i = 6; $i <= ($warehouseCount + 5); $i++) {
                    $setRow[$ROW[$i]] = 20;
                }
                $sheet->setWidth(array_merge($row, $setRow));

                //设置这个范围的值字体样式
                $sheet->setBorder('A1:' . $endRow . $number, 'thin');
                $sheet->cells('A1:' . $endRow . '1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });

                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:" . $endRow . $i, function ($cells) {
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
