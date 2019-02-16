<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Goods;
use App\Models\Staff;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class SalesSummaryGoodsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index salesSummaryGoods']);
    }

    /**
     * show  all data
     * @param object $request
     * @return void
     */
    public function index(Request $request)
    {
        $client = Client::all();
        $goods = Goods::all();
        $warehouse = Warehouse::all();
        $staff = Staff::all();
        $salesDetailsController = new SalesDetailsController();
        $model = $salesDetailsController->getData($request);
        return view('salesSummaryGoods.index', compact('client', 'goods', 'warehouse', 'staff', 'model'));
    }

    /**
     * 导出excel表格
     *
     * @return void
     */

    public function excel()
    {
        \Excel::create('销售总汇表(按商品)' . date('YmdHis'), function ($excel) {
            $excel->sheet('销售总汇表(按商品)', function ($sheet) {

                $salesDetailsController = new SalesDetailsController();
                $url = url()->previous();
                $newDataA = [];
                $newData = $salesDetailsController->search(getUrlKeyValue($url));
                foreach ($newData as $key => $value) {
                    $newDataA[$key]['goods_number'] = $value['goods_number'];
                    $newDataA[$key]['goods_name'] = $value['goods_name'];
                    $newDataA[$key]['specification'] = $value['specification'];
                    $newDataA[$key]['measurement'] = $value['measurement'];
                    $newDataA[$key]['warehouse_name'] = $value['warehouse_name'];
                    $newDataA[$key]['number'] = $value['number'];
                    $newDataA[$key]['unit_purchase_price'] = $value['unit_purchase_price'];
                    $newDataA[$key]['purchase_amount'] = $value['purchase_amount'];
                }

                $haha = array(
                    array('销售总汇表(按商品'),
                    array(
                        '商品编号',
                        '商品名称',
                        '规格型号',
                        '单位',
                        '仓库',
                        '数量',
                        '单价',
                        '销售收入'
                    ),
                    []
                );
                $zz = array_merge($haha, $newDataA);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('销售总汇表(按商品'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:H2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'),
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
                    'H' => 20,
                ));
                //设置这个范围的值字体样式
                $sheet->setBorder("A1:H$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:H$i", function ($cells) {
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
