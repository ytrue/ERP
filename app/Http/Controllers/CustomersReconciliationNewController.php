<?php

namespace App\Http\Controllers;

use App\Models\Salereturn;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomersReconciliationNewController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index customersReconciliationNew']);
    }

    public function index(Request $request)
    {
        $client = Client::all();
        return view('customersReconciliationNew.index', [
            'client' => $client,
            'model' => $this->getData($request),
        ]);
    }

    /**
     * @param object $request
     * @return object
     */
    public function getData($request)
    {
        $getData = $request->all();
        $newGetData = $this->judgeData($getData);
        $data = $this->sqlData($request->all());
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
            'client' => $newGetData['client']['value'],
        ]);
        return $data;

    }

    /**
     * @param array $getData
     * @return array
     */
    public function  sqlData($getData)
    {
        $newGetData = $this->judgeData($getData);

        $where = ['created_at', 'document_number', 'total_amount', 'paid', 'client_id','preferential_rate'];

        $sales = Sales::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('client_id', $newGetData['client']['where'],
                $newGetData['client']['value'])
            ->get($where);

        $salesReturn = Salereturn::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('client_id', $newGetData['client']['where'],
                $newGetData['client']['value'])
            ->get(@$where);

        $dataA = $this->arrayData($sales, '销货');
        $dataB = $this->arrayData($salesReturn,'销货退货');
        return array_merge($dataA, $dataB);
    }

    /**
     * @param object $data
     * @param string $type
     * @param array $status
     * @return array
     */
    private function arrayData($data, $type)
    {
        $newDataA = [];
        foreach ($data as $key => $value){
            $newDataA[$key]['name'] = $value->getClient->name;
            $newDataA[$key]['createTime'] = $value->created_at;
            $newDataA[$key]['documentNumber'] = $value->document_number;
            $newDataA[$key]['type'] = $type;
            if ($value->preferential_rate == 0){
                $newDataA[$key]['salesAmount']  = $value->total_amount;
                $newDataA[$key]['wholeSingleDiscount']  = 0;
            }else{
                $newDataA[$key]['salesAmount']  = sprintf("%.2f",($value->total_amount / ($value->preferential_rate /100)));
                $newDataA[$key]['wholeSingleDiscount']  = ($newDataA[$key]['salesAmount']- $value->total_amount);
            }
            $newDataA[$key]['totalAmount']  = $value->total_amount;
            $newDataA[$key]['paid'] = $value->paid;
            $newDataA[$key]['unpaidAmount'] =  sprintf("%.2f",($value->total_amount - $value->paid));
        }

        return $newDataA;
    }

    /**
     * @param object $getData
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
                    'value' => '2019-10-01',
                ],
                'client' => [
                    'where' => '!=',
                    'value' => '',
                ]
            ];
        }

        return $newGetData;
    }

    public function excel()
    {
        \Excel::create('客户对账单' . date('YmdHis'), function ($excel) {
            $excel->sheet('客户对账单)', function ($sheet) {

                $url = url()->previous();
                $newData = $this->sqlData(getUrlKeyValue($url));
                $haha = array(
                    array('客户对账单'),
                    array(
                        '客户',
                        '单据日期',
                        '单据编号',
                        '业务类型',
                        '销售金额',
                        '整单折扣额',
                        '应收金额',
                        '实际收款金额',
                        '应收款余额'
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('客户对账单'),
                ));


                //合并单元格
                $sheet->mergeCells('A1:I2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I'),
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
                ));
                //设置这个范围的值字体样式
                $sheet->setBorder("A1:I$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:I$i", function ($cells) {
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
