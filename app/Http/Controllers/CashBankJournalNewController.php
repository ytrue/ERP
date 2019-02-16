<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PaymentExtend;
use App\Models\Purchase;
use App\Models\Purchasereturn;
use App\Models\Salereturn;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CashBankJournalNewController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index cashBankJournalNew']);
    }

    public function index(Request $request)
    {
        $account = Account::all();
        return view('cashBankJournalNew.index', [
            'account' => $account,
             'model' => $this->getData($request),
        ]);
    }

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
            'account' => $newGetData['account']['value'],
        ]);
        return $data;

    }

    public function sqlData($getData)
    {
        $newGetData = $this->judgeData($getData);

        $purchaseField = ['settlement_account', 'created_at', 'document_number', 'paid', 'supplier_id'];

        $salesField = ['settlement_account', 'created_at', 'document_number', 'paid', 'client_id'];

        $purchase = Purchase::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('settlement_account', $newGetData['account']['where'],
                $newGetData['account']['value'])
            ->get($purchaseField);

        $purchaseReturn = Purchasereturn::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('settlement_account', $newGetData['account']['where'],
                $newGetData['account']['value'])
            ->get($purchaseField);

        $sales = Sales::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('settlement_account', $newGetData['account']['where'],
                $newGetData['account']['value'])
            ->get($salesField);

        $salesReturn = Salereturn::orderBy('created_at', 'desc')
            ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
            ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
            ->where('settlement_account', $newGetData['account']['where'],
                $newGetData['account']['value'])
            ->get($salesField);

        $paymentExtend = PaymentExtend::where('settlement_account', $newGetData['account']['where'],
            $newGetData['account']['value'])
            ->get();

        $data = array_merge(
            $this->payArrayData($paymentExtend),
            $this->newArray($purchase, 1),
            $this->newArray($purchaseReturn, 2),
            $this->newArray($sales, 3),
            $this->newArray($salesReturn, 4)
        );
       return $data;
    }

    private function newArray($object, $type)
    {
        $data = [];
        foreach ($object as $key => $value){
            $data[$key]['accountNumber'] = $value->getAccount->number;
            $data[$key]['accountName'] = $value->getAccount->name;
            $data[$key]['createTime'] = $value->created_at;
            $data[$key]['documentNumber'] = $value->document_number;
            switch ($type){
                case 1:
                    $data[$key]['type'] = '购货';
                    $data[$key]['income'] = null;  //收入
                    $data[$key]['expenditure'] = $value->paid;
                    $data[$key]['company'] = $value->getSupplierManagement->name;
                    break;
                case 2:
                    $data[$key]['type'] = '购货退货';
                    $data[$key]['income'] = $value->paid;
                    $data[$key]['expenditure'] = null;
                    $data[$key]['company'] = $value->getSupplierManagement->name;
                    break;
                case 3:
                    $data[$key]['type'] = '销货';
                    $data[$key]['income'] = $value->paid;
                    $data[$key]['expenditure'] = null;
                    $data[$key]['company'] = $value->getClient->name;
                    break;
                case 4:
                    $data[$key]['type'] = '销货退货';
                    $data[$key]['income'] = null;  //收入
                    $data[$key]['expenditure'] = $value->paid;
                    $data[$key]['company'] = $value->getClient->name;
                    break;
            }

        }

        return $data;
    }

    private function payArrayData($object)
    {
        $data = [];
        foreach ($object as $key => $value){
            $data[$key]['accountNumber'] = $value->getAccount->number;
            $data[$key]['accountName'] = $value->getAccount->name;
            $data[$key]['createTime'] = $value->getPayment->created_at;
            $data[$key]['documentNumber'] = $value->getPayment->ood_number;
            switch ($value->getPayment->type){
                case 1:
                    $data[$key]['type'] = '购货支付';
                    $data[$key]['income'] = null;  //收入
                    $data[$key]['expenditure'] = $value->payment_amount;
                    $data[$key]['company'] = $value->getOrder->getSupplierManagement->name;
                    break;
                case 2:
                    $data[$key]['type'] = '购货退款';
                    $data[$key]['income'] = $value->payment_amount;
                    $data[$key]['expenditure'] = null;
                    $data[$key]['company'] = $value->getOrderReturn->getSupplierManagement->name;
                    break;
                case 3:
                    $data[$key]['type'] = '销货收款';
                    $data[$key]['income'] = $value->payment_amount;
                    $data[$key]['expenditure'] = null;
                    $data[$key]['company'] = $value->getSales->getClient->name;
                    break;
                case 4:
                    $data[$key]['type'] = '销货退款';
                    $data[$key]['income'] = null;  //收入
                    $data[$key]['expenditure'] = $value->payment_amount;
                    $data[$key]['company'] = $value->getSalesReturn->getClient->name;
                    break;
            }

        }
        return $data;
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
                'account' => [
                    'where' => '!=',
                    'value' => '',
                ]
            ];
        }
        return $newGetData;
    }


    public function excel()
    {
        \Excel::create('现金银行报表' . date('YmdHis'), function ($excel) {
            $excel->sheet('现金银行报表)', function ($sheet) {
                $url = url()->previous();
                $newData = $this->sqlData(getUrlKeyValue($url));
                $haha = array(
                    array('现金银行报表'),
                    array(
                        '账户编号',
                        '账号名称',
                        '日期',
                        '单据编号',
                        '业务类型',
                        '收入',
                        '支出',
                        '来往单位'
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('现金银行报表'),
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
