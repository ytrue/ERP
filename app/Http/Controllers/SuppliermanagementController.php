<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Suppliermanagement;
use App\Models\SuppliermanagementExend;
use Illuminate\Http\Request;
use Excel;


class SuppliermanagementController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index supplierManagement'])->only(['index']);
        $this->middleware(['permission:add supplierManagement'])->only(['create']);
        $this->middleware(['permission:edit supplierManagement'])->only(['edit']);
        $this->middleware(['permission:delete supplierManagement'])->only(['destroy']);
        $this->middleware(['permission:status supplierManagement'])->only(['status']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierManagement = new Suppliermanagement();
        return view('supplier_managements.index', ['model' => $supplierManagement->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        return view('supplier_managements.create', ['supplier' => $supplier]);
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
            $supplierManagement = new Suppliermanagement();
            return $supplierManagement->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliermanagement $suppliermanagement)
    {
        return view('supplier_managements.show', compact('suppliermanagement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliermanagement $suppliermanagement)
    {
        $supplier = Supplier::all();
        return view('supplier_managements.edit', compact('suppliermanagement', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Suppliermanagement $suppliermanagement, Request $request)
    {
        if ($request->isMethod('put')) {
            $supplierManagement = new Suppliermanagement();
            return $supplierManagement->updateData($request->all(),
                $request->only(['contacts', 'phone', 'landline', 'qq', 'address']), $suppliermanagement);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (\request()->isMethod('delete')) {
            $idArray = json_decode($request->input('id'));
            \App\Models\Suppliermanagement::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $supplierManagement = new \App\Models\Suppliermanagement();
            if ($request->input('key') == 1) {
                return $supplierManagement->checkUnique($request->all(), 'name');
            } else {
                return $supplierManagement->checkUnique($request->all(), 'number');
            }
        }
    }


    /*修改状态*/
    public function status(Suppliermanagement $suppliermanagement)
    {
        if ($suppliermanagement->status == '<span class="label label-primary">已启动</span>') {
            $suppliermanagement->update(['status' => 2]);
            return '2';
        } else {
            if ($suppliermanagement->status == '<span class="label label-danger">已禁用</span>') {
                $suppliermanagement->update(['status' => 1]);
                return '1';
            }
        }
    }

    /*导出excel表*/
    public function excel()
    {
        Excel::create('供应商管理明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('供应商管理', function ($sheet) {

                $supplierManagement = Suppliermanagement::all();
                foreach ($supplierManagement as $key => $value) {
                    $newData[$key]['number'] = $value['number'];
                    $newData[$key]['name'] = $value['name'];
                    $newData[$key]['type'] = $value['type'];
                    $newData[$key]['balance_date'] = $value['balance_date'];
                    $newData[$key]['initial_payable'] = $value['initial_payable'];
                    $newData[$key]['initial_advance_payment'] = $value['initial_advance_payment'];
                    $newData[$key]['Initial_balance'] = ($value['initial_payable'] - $value['initial_advance_payment']);
                    $newData[$key]['rate'] = $value['rate'];
                    $newData[$key]['contacts'] = $value->getSupplierManagementExtend->contacts;
                    $newData[$key]['phone'] = $value->getSupplierManagementExtend->phone;
                    $newData[$key]['landline'] = $value->getSupplierManagementExtend->landline;
                    $newData[$key]['qq'] = $value->getSupplierManagementExtend->qq;
                    $newData[$key]['address'] = $value->getSupplierManagementExtend->address;
                }
                $haha = array(
                    array('供应商明细表'),
                    array(
                        '供应商编号',
                        '供应商名称',
                        '供应商类别',
                        '余额日期',
                        '初期应付款',
                        '初期预付款',
                        '初期来往余额',
                        '增值税税率',
                        '联系人',
                        '手机号码',
                        '座机号码',
                        'QQ/MSN',
                        '联系地址'
                    ),
                    []
                );
                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('供应商明细表'),
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
                    'A' => 15,
                    'B' => 15,
                    'C' => 15,
                    'D' => 15,
                    'E' => 15,
                    'F' => 15,
                    'G' => 15,
                    'H' => 15,
                    'I' => 15,
                    'J' => 15,
                    'K' => 15,
                    'L' => 15,
                    'M' => 15,
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

            })->export('xls');;
        });
    }
}
