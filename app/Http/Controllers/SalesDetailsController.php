<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Goods;
use App\Models\Staff;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SalesDetailsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index salesDetails']);
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
        $model = $this->getData($request);
        return view('salesDetails.index', compact('client', 'goods', 'warehouse', 'staff', 'model'));


    }

    /**
     * 自定义数组分页
     *
     * @access public
     * @param object $request
     * @return object
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
            'staff' => $newGetData['staff']['value'],
            'goods' => $newGetData['goods']['value'],
            'warehouse' => $newGetData['warehouse']['value'],
            'client' => $newGetData['client']['value'],
        ]);

        return $data;

    }

    /**
     * 调用 sqlData()这个方法
     *
     * @access public
     * @param  array $getData url地址get的参数
     * @return array
     */
    public function search($getData)
    {
        $dataA = $this->sqlData('sales_extends', 'sales', $getData);
        $dataB = $this->sqlData('salereturn_extends', 'salereturns', $getData);
        return array_merge($dataB, $dataA);
    }

    /**
     * 多表关联，获得sql里的数据
     *
     * @access private
     * @param  string $table1 数据表01
     * @param  string $table2 数据表02
     * @param  array $getData url地址get的参数
     * @return array
     */
    private function sqlData($table1, $table2, $getData)
    {
        $newGetData = $this->judgeData($getData);

        $newArray = [];

        $type = null;

        if ($table1 == 'sales_extends') {
            $type = '销货';
        } else {
            $type = '客户退货';
        }

        $data = DB::table($table1)
            ->join($table2, $table1 . '.sales_id', '=', $table2 . '.id')
            ->join('goods', $table1 . '.goods_id', '=', 'goods.id')
            ->join('warehouses', $table1 . '.warehouse_id', '=', 'warehouses.id')
            ->join('staffs', $table2 . '.staff_id', '=', 'staffs.id')
            ->join('clients', $table2 . '.client_id', '=', 'clients.id')
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
                'staffs.name as staff_name',
                'clients.name as client_name',
                $table2 . '.document_number as document_number',
                $table2 . '.created_at as created_at'
            )
            ->where($table1 . '.goods_id', $newGetData['goods']['where'], $newGetData['goods']['value'])
            ->where($table1 . '.warehouse_id', $newGetData['warehouse']['where'], $newGetData['warehouse']['value'])
            ->where($table2 . '.client_id', $newGetData['client']['where'], $newGetData['client']['value'])
            ->where($table2 . '.staff_id', $newGetData['staff']['where'], $newGetData['staff']['value'])
            ->whereDate($table2 . '.created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate($table2 . '.created_at', '<=', $newGetData['end_date']['value'])
            ->get();


        foreach ($data as $key => $value) {
            $newArray[$key]['created_at'] = $value->created_at;
            $newArray[$key]['document_number'] = $value->document_number;
            $newArray[$key]['type'] = $type;
            $newArray[$key]['staff_name'] = $value->staff_name;
            $newArray[$key]['client_name'] = $value->client_name;
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
                    'value' => '2100-10-01',
                ],
                'staff' => [
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
                'client' => [
                    'where' => '!=',
                    'value' => '',
                ]
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

        \Excel::create('销售明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('销售明细表', function ($sheet) {
                $url = url()->previous();
                $newData = $this->search(getUrlKeyValue($url));

                $haha = array(
                    array('销售明细表'),
                    array(
                        '销售日期',
                        '销售单据号',
                        '业务类型',
                        '销售人员',
                        '客户',
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

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);

                //A1的值
                $sheet->row(1, array(
                    ('销售明细表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:M2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'),
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
                    'M' => 20,
                ));

                //设置这个范围的值字体样式
                $sheet->setBorder("A1:M$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:M$i", function ($cells) {
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
