<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Purchasereturn;
use Illuminate\Http\Request;
use App\Models\Suppliermanagement;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountPayDetailsNewController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index accountPayDetailNew']);
    }

    public function index(Request $request)
    {
        $supplierManagement = Suppliermanagement::all();
        return view('accountPayDetailsNew.index', [
            'supplierManagement' => $supplierManagement,
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
            'supplierManagement' => $newGetData['supplierManagement']['value'],
        ]);
        return $data;

    }

    /**
     * @param array $getData
     * @return array
     */
    public function sqlData($getData)
    {
        $newGetData = $this->judgeData($getData);

        $where = ['created_at', 'document_number', 'total_amount', 'paid', 'supplier_id'];

        $purchase = Purchase::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('supplier_id', $newGetData['supplierManagement']['where'],
                $newGetData['supplierManagement']['value'])
            ->get($where);

        $purchaseReturn = Purchasereturn::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('supplier_id', $newGetData['supplierManagement']['where'],
                $newGetData['supplierManagement']['value'])
            ->get(@$where);

        $dataA = $this->arrayData($purchase, '购货', ['已付完全款', '部分付款', '未付款']);

        $dataB = $this->arrayData($purchaseReturn,'购货退货',  ['已退完全款', '部分退款', '未退款']);

        return array_merge($dataA, $dataB);
    }


    /**
     * @param object $data
     * @param string $type
     * @param array $status
     * @return array
     */
    private function arrayData($data, $type, $status)
    {
        $newDataA = [];
        foreach ($data as $key => $value){
            $newDataA[$key]['name'] = $value->getSupplierManagement->name;
            $newDataA[$key]['createTime'] = $value->created_at;
            $newDataA[$key]['documentNumber'] = $value->document_number;
            $newDataA[$key]['type'] = $type;
            $newDataA[$key]['totalAmount']  = $value->total_amount;
            $newDataA[$key]['paid'] = $value->paid;
            $newDataA[$key]['unpaidAmount'] =  sprintf("%.2f",($value->total_amount - $value->paid));
            if ( $value->total_amount ==  $value->paid) {
                $newDataA[$key]['paymentStatus'] =  $status[0];
            }else if ($value->total_amount >  $value->paid &&  $value->paid != 0) {
                $newDataA[$key]['paymentStatus'] = $status[1];
            }else if ( $value->paid == 0) {
                $newDataA[$key]['paymentStatus'] = $status[2];
            }
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
                'supplierManagement' => [
                    'where' => '!=',
                    'value' => '',
                ]
            ];
        }

        return $newGetData;
    }

    /**
     *
     */
    public function excel()
    {
        \Excel::create('应付账款明细表)' . date('YmdHis'), function ($excel) {
            $excel->sheet('应付账款明细表)', function ($sheet) {

                $url = url()->previous();
                $newData = $this->sqlData(getUrlKeyValue($url));

                $haha = array(
                    array('应付账款明细表'),
                    array(
                        '供应商',
                        '单据日期',
                        '单据编号',
                        '业务类型',
                        '应付款金额',
                        '已支付金额',
                        '未支付金额',
                        '付款状态'
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('应付账款明细表'),
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
