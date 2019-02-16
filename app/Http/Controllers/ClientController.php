<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Excel;

class ClientController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:index client'])->only(['index']);
        $this->middleware(['permission:add client'])->only(['create']);
        $this->middleware(['permission:edit client'])->only(['edit']);
        $this->middleware(['permission:delete client'])->only(['destroy']);
        $this->middleware(['permission:status client'])->only(['status']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $client = new Client();
        return view('clients.index', ['model' => $client->allData(\request()->get('search'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::all();
        return view('clients.create', ['customer' => $customer]);
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
            $client = new Client();
            return $client->addData($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $customer = Customer::all();
        return view('clients.edit', ['customer' => $customer, 'client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Client $client, Request $request)
    {
        if ($request->isMethod('put')) {
            $clientValidate = new \App\Http\Requests\Client();
            $validator = Validator::make($request->all(), $clientValidate->rules());
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                DB::beginTransaction();
                try {
                    $client->update($request->all());
                    $client->getClientExtend()->update([
                        'contacts' => $request->input('contacts'),
                        'phone' => $request->input('phone'),
                        'landline' => $request->input('landline'),
                        'qq' => $request->input('qq'),
                        'address' => $request->input('address'),
                        'info' => $request->input('info')
                    ]);
                    DB::commit();
                    return 'true';
                } catch (\Exception $exception) {
                    return DB::rollBack();
                }
            }
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
            \App\Models\Client::destroy($idArray);
            return 'true';
        }
    }

    /*验证name字段的唯一性*/
    public function checkUnique(Request $request)
    {
        if ($request->isMethod('post')) {
            $client = new \App\Models\Client();
            if ($request->input('key') == 1) {
                return $client->checkUnique($request->all(), 'name');
            } else {
                return $client->checkUnique($request->all(), 'number');
            }
        }
    }

    /*修改状态*/
    public function status(Client $client)
    {
        if ($client->status == '<span class="label label-primary">已启动</span>') {
            $client->update(['status' => 2]);
            return '2';
        } else {
            if ($client->status == '<span class="label label-danger">已禁用</span>') {
                $client->update(['status' => 1]);
                return '1';
            }
        }
    }

    /*导出excel表*/
    public function excel()
    {
        Excel::create('客户管理明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('客户管理', function ($sheet) {

                $client = Client::all();
                foreach ($client as $key => $value) {
                    $newData[$key]['number'] = $value['number'];
                    $newData[$key]['name'] = $value['name'];
                    $newData[$key]['type'] = $value['type'];
                    $newData[$key]['level'] = $value['level'];
                    $newData[$key]['balance_date'] = $value['balance_date'];
                    $newData[$key]['initial_payable'] = $value['initial_payable'];
                    $newData[$key]['initial_advance_payment'] = $value['initial_advance_payment'];
                    $newData[$key]['Initial_balance'] = ($value['initial_payable'] - $value['initial_advance_payment']);
                    $newData[$key]['contacts'] = $value->getClientExtend->contacts;
                    $newData[$key]['phone'] = $value->getClientExtend->phone;
                    $newData[$key]['landline'] = $value->getClientExtend->landline;
                    $newData[$key]['qq'] = $value->getClientExtend->qq;
                    $newData[$key]['address'] = $value->getClientExtend->address;
                }
                $haha = array(
                    array('客户明细表'),
                    array(
                        '客户编号',
                        '客户名称',
                        '客户类别',
                        '客户等级',
                        '余额日期',
                        '初期应付款',
                        '初期预付款',
                        '初期往来余额',
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
                    ('客户明细表'),
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
