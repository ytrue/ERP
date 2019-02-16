<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Models\Suppliermanagement;
use Illuminate\Support\Facades\DB;

class PurchasepaymentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index purchasePayment'])->only(['index']);
        $this->middleware(['permission:add purchasePayment'])->only(['create']);
    }

    /**
     * show all data
     */
    public function index()
    {
        $supplierManagement = Suppliermanagement::where('status', 1)->get();  //where =1
        $payment = new Payment();
        return view('purchasePayment.index', [
            'model' => $payment->allData(\request()->all(), 1),
            'supplierManagement' => $supplierManagement
        ]);
    }

    /**
     * add data
     */
    public function create()
    {

        $settlement = Settlement::all();  //结算方式
        $account = Account::all();  //账户
        $purchasesCount = DB::table('purchases')->groupBy('supplier_id')->get(['supplier_id'])->count();
        return view('purchasePayment.create', compact('purchasesCount', 'settlement', 'account'));
    }


    /**
     * add data  mysql
     */

    public function store(Request $request)
    {
        $payment = new Payment();
        $type = 'purchasePayment';
        return $payment->addData($request->all(), $type);
    }

    /**
     *  find one data
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        return view('purchasePayment.show', compact('payment'));
    }

    /**
     * get Supplier  data
     */
    public function get_supplier(Request $request)
    {
        $newArrayId = [];
        $ids = DB::table('purchases')->groupBy('supplier_id')->get(['supplier_id']);
        foreach ($ids as $key => $value) {
            $newArrayId[$key] = $value->supplier_id;
        }

        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return DB::table('suppliermanagements')
                ->whereIn('id', $newArrayId)
                ->join('suppliermanagement_extends', 'suppliermanagements.id', '=', 'suppliermanagement_extends.s_id')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return DB::table('suppliermanagements')
                ->whereIn('id', $newArrayId)
                ->join('suppliermanagement_extends', 'suppliermanagements.id', '=', 'suppliermanagement_extends.s_id')
                ->skip(0)
                ->take(10)
                ->get();
        }

    }

    /**
     *get  purchase  data
     */
    public function get_purchase(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return Purchase::where('supplier_id', $request->input('supplier_id'))
                ->whereColumn('paid', '!=', 'total_amount')
                ->orderBy('created_at', 'desc')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return Purchase::where('supplier_id', $request->input('supplier_id'))
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
            $purchase = Purchase::find($request->input('purchaseId'));
            $newArray = [];
            foreach ($purchase->getPurchaseExtend as $key => $value) {
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
        \Excel::create('购货付款表' . date('YmdHis'), function ($excel) {
            $excel->sheet('购货付款表', function ($sheet) {
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
                    ->where('type', 1)
                    ->where('ood_number', 'like', "%$documentNumber%")
                    ->where('unit_id', $newGetData['unit']['where'], $newGetData['unit']['value'])
                    ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
                    ->get();

                $newData = [];

                foreach ($excelData as $key => $value){
                    $newData[$key]['createTime'] = $value->created_at;
                    $newData[$key]['oodNumber'] = $value->ood_number;
                    $newData[$key]['unitName'] = $value->getSupplierManagement->name;
                    $newData[$key]['paymentAmount'] = 0;
                    for ($i = 0; $i <sizeof($value->getPaymentExtend); $i++){
                        $newData[$key]['paymentAmount']+=$value->getPaymentExtend[$i]->payment_amount;
                    }
                    $newData[$key]['paymentAmount'] = sprintf("%.2f", $newData[$key]['paymentAmount']);
                    $newData[$key]['userName'] = $value->getUser->name;
                }

                $haha = array(
                    array('购货付款表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '购货单位',
                        '付款总金额',
                        '制单人'
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('购货付款表'),
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
