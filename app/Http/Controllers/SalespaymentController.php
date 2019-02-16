<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Salereturn;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalespaymentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index salesPayment'])->only(['index']);
        $this->middleware(['permission:add salesPayment'])->only(['create']);
    }
    /**
     * show all data
     */
    public function index()
    {
        $client = Client::where('status', 1)->get();
        $payment = new Payment();
        return view('salesPayment.index', [
            'model' => $payment->allData(\request()->all(), 4),
            'client' => $client
        ]);
    }

    /**
     * add data
     */
    public function create()
    {
        $settlement = Settlement::all();  //结算方式
        $account = Account::all();  //账户
        $purchasesCount = DB::table('sales')->groupBy('client_id')->get(['client_id'])->count();
        return view('salesPayment.create', compact('purchasesCount', 'settlement', 'account'));
    }

    /**
     * add data  mysql
     */

    public function store(Request $request)
    {
        $payment = new Payment();
        $type = 'salesPayment';
        return $payment->addData($request->all(), $type);
    }

    /**
     *  find one data
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        return view('salesPayment.show', compact('payment'));
    }

    /**
     * get Supplier  data
     */
    public function get_client(Request $request)
    {
        $newArrayId = [];
        $ids = DB::table('salereturns')->groupBy('client_id')->get(['client_id']);
        foreach ($ids as $key => $value) {
            $newArrayId[$key] = $value->client_id;
        }

        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return DB::table('clients')
                ->whereIn('id', $newArrayId)
                ->join('client_extends', 'clients.id', '=', 'client_extends.c_id')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return DB::table('clients')
                ->whereIn('id', $newArrayId)
                ->join('client_extends', 'clients.id', '=', 'client_extends.c_id')
                ->skip(0)
                ->take(10)
                ->get();
        }
    }


    /**
     *get  purchase  data
     */
    public function get_sales(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return Salereturn::where('client_id', $request->input('supplier_id'))
                ->whereColumn('paid', '!=', 'total_amount')
                ->orderBy('created_at', 'desc')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return Salereturn::where('client_id', $request->input('supplier_id'))
                ->whereColumn('paid', '!=', 'total_amount')
                ->orderBy('created_at', 'desc')
                ->skip(0)
                ->take(10)
                ->get();
        }
    }

    public function get_details(Request $request)
    {
        if ($request->isMethod('post')) {
            $purchase = Salereturn::find($request->input('purchaseId'));
            $newArray = [];
            foreach ($purchase->getSaleReturnExtend as $key => $value) {
                $newArray[$key]['number'] = $value->getGoods->number;
                $newArray[$key]['name'] = $value->getGoods->name;
                $newArray[$key]['measurement'] = $value->getGoods->measurement;
                $newArray[$key]['goods_number'] = $value->number;
                $newArray[$key]['purchase_amount'] = $value->purchase_amount;
            }
            return $newArray;
        }
    }

    public function excel()
    {
        \Excel::create('销货退款表' . date('YmdHis'), function ($excel) {
            $excel->sheet('销货退款表', function ($sheet) {
                $url = url()->previous();

                $getData = getUrlKeyValue($url);

                $newGetData = judgeData($getData, [
                    'unit' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                    'document_number' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                ]);

                $documentNumber = $newGetData['document_number']['value'];

                $excelData = Payment::orderBy('created_at', 'desc')
                    ->where('type', 4)
                    ->where('ood_number', 'like', "%$documentNumber%")
                    ->where('unit_id', $newGetData['unit']['where'], $newGetData['unit']['value'])
                    ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
                    ->get();

                $newData = [];

                foreach ($excelData as $key => $value){
                    $newData[$key]['createTime'] = $value->created_at;
                    $newData[$key]['oodNumber'] = $value->ood_number;
                    $newData[$key]['unitName'] = $value->getClient->name;
                    $newData[$key]['paymentAmount'] = 0;
                    for ($i = 0; $i <sizeof($value->getPaymentExtend); $i++){
                        $newData[$key]['paymentAmount']+=$value->getPaymentExtend[$i]->payment_amount;
                    }
                    $newData[$key]['paymentAmount'] = sprintf("%.2f", $newData[$key]['paymentAmount']);
                    $newData[$key]['userName'] = $value->getUser->name;
                }

                $haha = array(
                    array('销货退款表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '销货单位',
                        '收款总金额',
                        '制单人'
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('销货退款表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:E2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E'),
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
                ));


                //设置这个范围的值字体样式
                $sheet->setBorder("A1:E$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:E$i", function ($cells) {
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
