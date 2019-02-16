<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sales;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Warehouse;
use App\Models\Goods;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index sale'])->only(['index']);
        $this->middleware(['permission:add sale'])->only(['create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where('status', 1)->get();
        $staff = Staff::where('status', 1)->get();
        $sales = new Sales();
        return view('sales.index', [
            'model' => $sales->allData(\request()->all()),
            'client' => $client,
            'staff' => $staff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client();
        $goods = new Goods();
        $account = Account::all();
        $warehouse = Warehouse::all();
        $staff = Staff::where('status', 1)->count();
        return view('sales.create', [
            'account' => $account,
            'warehouse' => $warehouse,
            'goods' => $goods,
            'client' => $client,
            'staff_count' => $staff
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
            $sales = new Sales();
            return $sales->addData($data, $dataExtend);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = Sales::find($id);
        return view('sales.show', compact('sales'));
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

    /*获得客户*/
    public function get_client(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            return DB::table('clients')
                ->join('client_extends', 'clients.id', '=', 'client_extends.c_id')
                ->skip($num2)
                ->take(10)
                ->get();
        } else {
            return DB::table('clients')
                ->join('client_extends', 'clients.id', '=', 'client_extends.c_id')
                ->skip(0)
                ->take(10)
                ->get();
        }
    }

    /*获得职员*/
    public function get_staff(Request $request)
    {
        if ($request->has('id')) {
            $num1 = $request->input('id');
            $num2 = ($num1 - 1) * 10;
            $staff = Staff::where('status', '1')->orderBy('created_at', 'desc')->skip($num2)->take(10)->get();
            return $staff;
        } else {
            $staff = Staff::where('status', '1')->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
            return $staff;
        }
    }

    public function excel()
    {
        \Excel::create('销货明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('销货明细表', function ($sheet) {

                $url = url()->previous();

                $getData = getUrlKeyValue($url);

                $newGetData = judgeData($getData, [
                    'client' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                    'staff' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                    'document_number' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                    'status' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                ]);


                $documentNumber = $newGetData['document_number']['value'];

                $excelData = Sales::orderBy('status')
                    ->orderBy('created_at', 'desc')
                    ->where('document_number', 'like', "%$documentNumber%")
                    ->where('client_id', $newGetData['client']['where'], $newGetData['client']['value'])
                    ->where('staff_id', $newGetData['staff']['where'], $newGetData['staff']['value'])
                    ->whereDate('created_at', '>=', $newGetData['start_date']['value'])
                    ->whereDate('created_at', '<=', $newGetData['end_date']['value'])
                    ->get();

                $newData = [];

                foreach ($excelData as $key => $value){
                    $newData[$key]['createTime'] = $value->created_at;
                    $newData[$key]['documentNumber'] = $value->document_number;
                    $newData[$key]['clientName'] = $value->getClient->name;
                    $newData[$key]['staffName'] = $value->getStaff->name;
                    $newData[$key]['purchaseAmount'] = 0;
                    for ($i = 0; $i <sizeof($value->getSalesExtend); $i++){
                        $newData[$key]['purchaseAmount']+=$value->getSalesExtend[$i]->purchase_amount;
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
                        $newData[$key]['status'] = '未收款';
                    }else if ($value->paid < $newData[$key]['amountAfterPreference']){
                        $newData[$key]['status'] = '部分收款';
                    }else if($value->paid == $newData[$key]['amountAfterPreference']){
                        $newData[$key]['status'] = '已收完全款';
                    }
                    $newData[$key]['user'] = $value->getUser->name;
                }

                $haha = array(
                    array('销货明细表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '客户',
                        '销售人员',
                        '销货金额',
                        '优惠后金额',
                        '已收款',
                        '收款状态',
                        '制单人',
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('销货明细表'),
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
