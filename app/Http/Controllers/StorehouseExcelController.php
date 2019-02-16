<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Purchasereturn;
use App\Models\Salereturn;
use App\Models\Sales;
use Illuminate\Http\Request;

class StorehouseExcelController extends Controller
{

    /**
     *购货入库
     */
    public function purchase_excel()
    {
        \Excel::create('购货入库明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('购货入库明细表', function ($sheet) {
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
                    'status' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                ]);

                $documentNumber = $newGetData['document_number']['value'];

                $excelData = Purchase::orderBy('status')
                    ->orderBy('created_at', 'desc')
                    ->where('document_number', 'like', "%$documentNumber%")
                    ->where('supplier_id', $newGetData['supplierManagement']['where'], $newGetData['supplierManagement']['value'])
                    ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
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
                    if ($value->status == '<span class="label label-primary">已入库</span>'){
                        $newData[$key]['rkStatus'] = '已入库';
                    }else{
                        $newData[$key]['rkStatus'] = '未入库';
                    }

                }

                $haha = array(
                    array('购货入库明细表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '供应商',
                        '购货金额',
                        '优惠后金额',
                        '已付款',
                        '付款状态',
                        '制单人',
                        '入库状态',
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('购货入库明细表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:I2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G','H','I'),
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

    public function purchase_return_excel()
    {
        \Excel::create('购货退货出库明细表' . date('YmdHis'), function ($excel) {
            $excel->sheet('购货退货出库明细表', function ($sheet) {
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
                    'status' => [
                        'where' => '!=',
                        'value' => '',
                    ],
                ]);

                $documentNumber = $newGetData['document_number']['value'];

                $excelData = Purchasereturn::orderBy('status')
                    ->orderBy('created_at', 'desc')
                    ->where('document_number', 'like', "%$documentNumber%")
                    ->where('supplier_id', $newGetData['supplierManagement']['where'], $newGetData['supplierManagement']['value'])
                    ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
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
                        $newData[$key]['status'] = '已退完全款';
                    }
                    $newData[$key]['user'] = $value->getUser->name;
                    if ($value->status == '<span class="label label-primary">已出库</span>'){
                        $newData[$key]['rkStatus'] = '已出库';
                    }else{
                        $newData[$key]['rkStatus'] = '未处理';
                    }

                }

                $haha = array(
                    array('购货退货出库明细表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '供应商',
                        '购货金额',
                        '优惠后金额',
                        '已退款',
                        '退款状态',
                        '制单人',
                        '出库状态',
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('购货退货出库明细表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:I2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G','H','I'),
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

    public function get_sales_execl()
    {
        \Excel::create('客户订单出库表' . date('YmdHis'), function ($excel) {
            $excel->sheet('客户订单出库表', function ($sheet) {
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
                    ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
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

                    if ($value->status == '<span class="label label-primary">已出库</span>'){
                        $newData[$key]['rkStatus'] = '已出库';
                    }else{
                        $newData[$key]['rkStatus'] = '未处理';
                    }

                }

                $haha = array(
                    array('客户订单出库表'),
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
                        '出库状态',
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('客户订单出库表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:J2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G','H','I','J'),
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
                    'J' => 20,
                ));

                //设置这个范围的值字体样式
                $sheet->setBorder("A1:J$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:J$i", function ($cells) {
                        $cells->setFontSize(10);//字体大小
                        $cells->setValignment('center');//字体垂直居中
                        $cells->setAlignment('center');//字体水平居中
                        $cells->setBorder('thin', 'thin', 'thin', 'thin');//设置表格边框
                    });
                }

            })->export('xls');
        });

    }

    public function get_sales_return_excel()
    {
        \Excel::create('客户退货订单表' . date('YmdHis'), function ($excel) {
            $excel->sheet('客户退货订单表', function ($sheet) {
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

                $excelData = Salereturn::orderBy('status')
                    ->orderBy('created_at', 'desc')
                    ->where('document_number', 'like', "%$documentNumber%")
                    ->where('client_id', $newGetData['client']['where'], $newGetData['client']['value'])
                    ->where('staff_id', $newGetData['staff']['where'], $newGetData['staff']['value'])
                    ->where('status', $newGetData['status']['where'], $newGetData['status']['value'])
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

                    for ($i = 0; $i <sizeof($value->getSaleReturnExtend); $i++){
                        $newData[$key]['purchaseAmount']+=$value->getSaleReturnExtend[$i]->purchase_amount;
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

                    if ($value->status == '<span class="label label-primary">已入库</span>'){
                        $newData[$key]['rkStatus'] = '已入库';
                    }else{
                        $newData[$key]['rkStatus'] = '未入库';
                    }
                }

                $haha = array(
                    array('客户退货订单表'),
                    array(
                        '单据日期',
                        '单据编号',
                        '客户',
                        '销售人员',
                        '销货金额',
                        '优惠后金额',
                        '已退款',
                        '退款状态',
                        '制单人',
                        '出库状态',
                    ),
                    []
                );

                $zz = array_merge($haha, $newData);
                $number = sizeof($zz) + 1;
                $sheet->with($zz);
                //A1的值
                $sheet->row(1, array(
                    ('客户退货订单表'),
                ));

                //合并单元格
                $sheet->mergeCells('A1:J2');
                $sheet->setMergeColumn(array(
                    'columns' => array('A', 'B', 'C', 'D', 'E', 'F', 'G','H','I','J'),
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
                    'J' => 20,
                ));

                //设置这个范围的值字体样式
                $sheet->setBorder("A1:J$number", 'thin');
                $sheet->cells('A1:U1', function ($cells) {
                    $cells->setFontSize(16);//字体大小
                    $cells->setValignment('center');//字体垂直居中
                    $cells->setAlignment('center');//字体水平居中
                    $cells->setBorder('none', 'none', 'thin', 'none');//设置表格边框
                });
                for ($i = 3; $i <= $number; $i++) {
                    $sheet->cells("A$i:J$i", function ($cells) {
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
