<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Goods;
use App\Models\Purchase;
use App\Models\Suppliermanagement;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index purchase'])->only(['index']);
        $this->middleware(['permission:add purchase'])->only(['create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierManagement = Suppliermanagement::where('status', 1)->get();  //where =1
        $purchase = new Purchase();
        return view('purchases.index',
            ['model' => $purchase->allData(\request()->all()), 'supplierManagement' => $supplierManagement]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods = new Goods();
        $supplierManagement = new Suppliermanagement();
        $account = Account::all();
        $warehouse = Warehouse::all();
        return view('purchases.create', [
            'supplierManagement' => $supplierManagement,
            'goods' => $goods,
            'account' => $account,
            'warehouse' => $warehouse
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('data');
            $dataExtend = $request->only('data');
            $purchase = new Purchase();
            return $purchase->addData($data, $dataExtend);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {

        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //获得供应商数据
    public function get_data(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return DB::table('suppliermanagements')
                ->join('suppliermanagement_extends', 'suppliermanagements.id', '=', 'suppliermanagement_extends.s_id')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return DB::table('suppliermanagements')
                ->join('suppliermanagement_extends', 'suppliermanagements.id', '=', 'suppliermanagement_extends.s_id')
                ->skip(0)
                ->take(10)
                ->get();
        }
    }

    //获得商品
    public function get_shop(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            $goods = Goods::orderBy('created_at', 'desc')->skip($num2)->take(10)->get();
            return $goods;
        } else {
            $goods = Goods::orderBy('created_at', 'desc')->skip(0)->take(10)->get();
            return $goods;
        }
    }

    public function excel()
    {
        \Excel::create('购货明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('购货明细表', function ($sheet) {



                $url = url()->previous();

                $getData = getUrlKeyValue($url);

                $newGetData = judgeData($getData, [
                    'supplierManagement' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                    'document_number' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                ]);

                $documentNumber = $newGetData['document_number']['value'];

                $excelData = Purchase::orderBy('status')
                    ->orderBy('created_at', 'desc')
                    ->where('document_number', 'like', "%$documentNumber%")
                    ->where('supplier_id', $newGetData['supplierManagement']['where'], $newGetData['supplierManagement']['value'])
                    ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
                    ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
                    ->get();

                $newData = [];

                foreach ($excelData as $key => $value){
                    $newData[$key]['createTime'] = $value->created_at;
                    $newData[$key]['documentNumber'] = $value->document_number;
                    $newData[$key]['supplierName'] = $value->getSupplierManagement->name;
                    $newData[$key]['purchaseAmount'] = 0;
                    for ($i = 0; $i <sizeof($value->getPurchaseExtend); $i++){
                        $newData[$key]['purchaseAmount']+=$value->getPurchaseExtend[$i]->purchase_amount;
                    }

                    $newData[$key]['purchaseAmount'] = sprintf("%.2f",$newData[$key]['purchaseAmount']);

                    if ($value->preferential_rate == 0){
                        $newData[$key]['amountAfterPreference'] = sprintf("%.2f",$newData[$key]['purchaseAmount']);
                    }else{
                        $preferential_rate = ($value->preferential_rate/100);
                        $newData[$key]['amountAfterPreference'] = sprintf("%.2f",$newData[$key]['purchaseAmount']*$preferential_rate);
                    }

                    $newData[$key]['paid'] = $value->paid;

                    if ($value->paid==0){
                        $newData[$key]['status'] = '未付款';
                    }else if ($value->paid < $newData[$key]['amountAfterPreference']){
                        $newData[$key]['status'] = '部分付款';
                    }else if($value->paid == $newData[$key]['amountAfterPreference']){
                        $newData[$key]['status'] = '已付完全款';
                    }
                    $newData[$key]['user'] = $value->getUser->name;

                }
                $haha = array(
                    array('购货明细表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '供应商',
                        '购货金额',
                        '优惠后金额',
                        '已付款',
                        '付款状态',
                        '制单人',
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('购货明细表'),
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
