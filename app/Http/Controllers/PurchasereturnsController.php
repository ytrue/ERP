<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Goods;
use App\Models\Purchasereturn;
use App\Models\Suppliermanagement;
use App\Models\Warehouse;
use App\Models\WarehouseGoodsNumber;
use Illuminate\Http\Request;

class PurchasereturnsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index purchaseReturns'])->only(['index']);
        $this->middleware(['permission:add purchaseReturns'])->only(['create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierManagement = Suppliermanagement::where('status', 1)->get();  //where =1
        $purchaseReturn = new Purchasereturn();
        return view('purchasereturns.index', [
            'model' => $purchaseReturn->allData(\request()->all()),
            'supplierManagement' => $supplierManagement
        ]);
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
        return view('purchasereturns.create', [
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
            $purchase = new Purchasereturn();
            return $purchase->addData($data, $dataExtend);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchasereturn $purchasereturn)
    {

        return view('purchasereturns.show', compact('purchasereturn'));
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


    public function get_warehouse(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->has('id')) {
                $num1 = $request->input('id');
                $num2 = ($num1 - 1) * 10;
                $data = WarehouseGoodsNumber::distinct()
                    ->skip($num2)
                    ->take(10)
                    ->get(['warehouse_id']);
                return $this->getWarehouse($data);
            } else {
                $data = WarehouseGoodsNumber::distinct()
                    ->skip(0)
                    ->take(10)
                    ->get(['warehouse_id']);
                return $this->getWarehouse($data);
            }
        }
    }

    private function getWarehouse($data)
    {
        $newArray = [];
        foreach ($data as $key => $value) {
            $newArray[$key]['id'] = $value->getWarehouse->id;  //商品编号
            $newArray[$key]['number'] = $value->getWarehouse->number;  //商品编号
            $newArray[$key]['name'] = $value->getWarehouse->name;  //商品名称
        }
        return $newArray;
    }


    public function get_shop(Request $request)
    {
        if ($request->isMethod('post')) {
            $warehouse_id = $request->post('warehouse_id');
            if ($request->has('id')) {
                $num1 = $request->input('id');
                $num2 = ($num1 - 1) * 10;
                $data = WarehouseGoodsNumber::where('warehouse_id', $warehouse_id)
                    ->skip($num2)
                    ->take(10)
                    ->get();
                return $this->getData($data);
            } else {
                $data = WarehouseGoodsNumber::where('warehouse_id', $warehouse_id)
                    ->skip(0)
                    ->take(10)
                    ->get();
                return $this->getData($data);

            }

        }
    }

    private function getData($data)
    {
        $newArray = [];
        foreach ($data as $key => $value) {
            $newArray[$key]['id'] = $value->getGoods->id;  //商品编号
            $newArray[$key]['number'] = $value->getGoods->number;  //商品编号
            $newArray[$key]['name'] = $value->getGoods->name;  //商品名称
            $newArray[$key]['predicted_price'] = $value->getGoods->predicted_price;  //预计采购单价
            $newArray[$key]['specification'] = $value->getGoods->specification;  //规格型号
            $newArray[$key]['measurement'] = $value->getGoods->measurement;  //计量单位
            $newArray[$key]['current_inventory'] = $value->number;  ////当前库存
        }
        return $newArray;
    }

    public function excel()
    {
        \Excel::create('购货退货明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('购货退货明细表', function ($sheet) {

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

            $excelData = Purchasereturn::orderBy('status')
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
                for ($i = 0; $i <sizeof($value->getPurchasereturnExtend); $i++){
                    $newData[$key]['purchaseAmount']+=$value->getPurchasereturnExtend[$i]->purchase_amount;
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
                    $newData[$key]['status'] = '未退款';
                }else if ($value->paid < $newData[$key]['amountAfterPreference']){
                    $newData[$key]['status'] = '部分退款';
                }else if($value->paid == $newData[$key]['amountAfterPreference']){
                    $newData[$key]['status'] = '已全部退款';
                }
                $newData[$key]['user'] = $value->getUser->name;

            }

                $haha = array(
                    array('购货退货明细表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '供应商',
                        '退货金额',
                        '优惠后金额',
                        '已退款',
                        '退款状态',
                        '制单人',
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('购货退货明细表'),
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
