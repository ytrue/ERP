<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Suppliermanagement;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProcurementDetailsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index procurementDetails']);
    }

    /**
     * show all data
     */
    public function index(Request $request)
    {
        $goods = Goods::all();
        $warehouse = Warehouse::all();
        $supplierManagement = Suppliermanagement::all();
        return view('procurementDetails.index', [
            'goods' => $goods,
            'warehouse' => $warehouse,
            'supplierManagement' => $supplierManagement,
            'model' => $this->getData($request),
        ]);
    }

    /**
     * Custom Array Pages
     */
    public function getData($request)
    {
        $getData = $request->all();
        $newGetData = $this->judgeData($getData);
        $data = $this->search($request->all());
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
            'start_date' => $newGetData['start_date']['value'],
            'end_date' => $newGetData['end_date']['value'],
            'supplierManagement' => $newGetData['supplierManagement']['value'],
            'goods' => $newGetData['goods']['value'],
            'warehouse' => $newGetData['warehouse']['value'],
        ]);
        return $data;

    }

    /**
     *调用多表查询数据的方法 sqlData()
     */
    public function search($getData)
    {
        $dataA = $this->sqlData('purchasereturn_extends', 'purchasereturns', $getData);
        $dataB = $this->sqlData('purchase_extends', 'purchases', $getData);
        return array_merge($dataB, $dataA);
    }


    /**
     * 多表查询数据
     */
    private function sqlData($table1, $table2, $getData)
    {
        $newGetData = $this->judgeData($getData);

        $newArray = [];

        $type = null;

        if ($table1 == 'purchasereturn_extends') {
            $type = '退货';
        } else {
            $type = '采购';
        }

        $data = DB::table($table1)
            ->join($table2, $table1 . '.purchase_id', '=', $table2 . '.id')
            ->join('goods', $table1 . '.goods_id', '=', 'goods.id')
            ->join('warehouses', $table1 . '.warehouse_id', '=', 'warehouses.id')
            ->orderBy($table2 . '.created_at', 'desc')
            ->select(
                $table1 . '.number as number',
                $table1 . '.unit_purchase_price as unit_purchase_price',
                $table1 . '.purchase_amount as purchase_amount',
                'warehouses.name as warehouse_name',
                'goods.measurement as measurement',
                'goods.specification as specification',
                'goods.name as goods_name',
                'goods.number as goods_number',
                $table2 . '.supplier_name as supplierManagement',
                $table2 . '.document_number as document_number',
                $table2 . '.created_at as created_at'
            )
            ->where($table1 . '.goods_id', $newGetData['goods']['where'], $newGetData['goods']['value'])
            ->where($table1 . '.warehouse_id', $newGetData['warehouse']['where'], $newGetData['warehouse']['value'])
            ->where($table2 . '.supplier_id', $newGetData['supplierManagement']['where'],
                $newGetData['supplierManagement']['value'])
            ->whereDate($table2 . '.created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate($table2 . '.created_at', '<=', $newGetData['end_date']['value'])
            ->get();

        foreach ($data as $key => $value) {
            $newArray[$key]['created_at'] = $value->created_at;
            $newArray[$key]['document_number'] = $value->document_number;
            $newArray[$key]['type'] = $type;
            $newArray[$key]['supplierManagement'] = $value->supplierManagement;
            $newArray[$key]['goods_number'] = $value->goods_number;
            $newArray[$key]['goods_name'] = $value->goods_name;
            $newArray[$key]['specification'] = $value->specification;
            $newArray[$key]['measurement'] = $value->measurement;
            $newArray[$key]['warehouse_name'] = $value->warehouse_name;
            $newArray[$key]['number'] = $value->number;
            $newArray[$key]['unit_purchase_price'] = $value->unit_purchase_price;
            $newArray[$key]['purchase_amount'] = $value->purchase_amount;
        }

        return $newArray;
    }

    /**
     * 判断get的数据是否为空 并且做个数据的修改
     */
    private function judgeData($getData)
    {
        $newGetData = [];
        if (!empty($getData)) {
            foreach ($getData as $key => $value) {
                if (empty($value)) {
                    switch ($key) {
                        case 'start_date':
                            $newGetData[$key]['where'] = '>=';
                            $newGetData[$key]['value'] = '1997-01-01';
                            break;
                        case 'end_date':
                            $newGetData[$key]['where'] = '<=';
                            $newGetData[$key]['value'] = '2100-01-01';
                            break;
                        default:
                            $newGetData[$key]['where'] = '!=';
                            $newGetData[$key]['value'] = '';
                            break;
                    }
                } else {
                    $newGetData[$key]['where'] = '=';
                    $newGetData[$key]['value'] = $value;
                }
            }
        } else {
            $newGetData = [
                'start_date' => [
                    'where' => '>=',
                    'value' => '1997-01-01',
                ],
                'end_date' => [
                    'where' => '!=',
                    'value' => '2019-10-01',
                ],
                'supplierManagement' => [
                    'where' => '!=',
                    'value' => '',
                ],
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


    /*
     * 导出execl表格
     */

    /**
     *
     */


    public function excel()
    {

        \Excel::create('采购明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('采购明细表', function ($sheet) {

                $url = url()->previous();
                $newData = $this->search(getUrlKeyValue($url));

                $haha = array(
                    array('采购明细表'),
                    array(
                        '采购日期',
                        '采购单据号',
                        '业务类型',
                        '供应商',
                        '商品编号',
                        '商品名称',
                        '规格型号',
                        '单位',
                        '仓库',
                        '数量',
                        '单价',
                        '采购金额'
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);


                //A1的值
                $sheet->row(1, array(
                    ('采购明细表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:L2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'),
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
                    'I' => 20,
                    'J' => 20,
                    'K' => 20,
                    'L' => 20,
                ));

                //设置这个范围的值字体样式
                $sheet->setBorder("A1:L$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:L$i", function ($cells) {
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
