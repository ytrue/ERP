<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login
Route::get('/login', 'LoginController@login')->name('login');
Route::post('/loginCheck', "\App\Http\Controllers\LoginController@loginCheck");
Route::get('/logout', "\App\Http\Controllers\LoginController@logout");

//主页
Route::get('/','IndexController');
//首页
Route::get('/index','HomeController');

/*购货管理*/
//调拨单
Route::get('allocation', 'AllocationController@index');
Route::get('allocation/create', 'AllocationController@create');
Route::post('allocation', 'AllocationController@store');
Route::get('allocation/{allocation}', 'AllocationController@show');
//盘点
Route::get('inventory/excel','InventoryController@excel');
Route::get('inventory','InventoryController@index');
//购货
Route::get('purchase/excel','PurchaseController@excel');
Route::post('purchase/get_shop','PurchaseController@get_shop');
Route::post('purchase/get_data','PurchaseController@get_data');
Route::resource('purchase','PurchaseController');
//购货退货
Route::get('purchasereturns/excel','PurchasereturnsController@excel');
Route::post('purchasereturns/get_warehouse','PurchasereturnsController@get_warehouse');
Route::post('purchasereturns/get_shop','PurchasereturnsController@get_shop');
Route::resource('purchasereturns','PurchasereturnsController');
/*销货管理*/
Route::get('sales/excel','SalesController@excel');
Route::post('sales/get_staff','SalesController@get_staff');
Route::post('sales/get_client','SalesController@get_client');
Route::resource('sales','SalesController');
//销货退货
Route::get('salereturn/excel','SalereturnController@excel');
Route::resource('salereturn','SalereturnController');

/*仓库管理*/
//购货入库
Route::get('get_purchase/excel','StorehouseExcelController@purchase_excel');
Route::get('get_purchase','StorehouseController@getPurchase');
Route::post('purchase_status','StorehouseController@purchaseStatus');
//购货退货出库
Route::get('get_purchase_return/excel','StorehouseExcelController@purchase_return_excel');
Route::get('get_purchase_return','StorehouseController@getPurchaseReturn');
Route::post('purchase_return_status','StorehouseController@purchaseReturnStatus');
//客户订单出库
Route::get('get_sales/excel','StorehouseExcelController@get_sales_execl');
Route::get('get_sales','StorehouseController@getSales');
Route::post('sales_status','StorehouseController@salesStatus');
//客户退货入库
Route::get('get_sale_return/excel','StorehouseExcelController@get_sales_return_excel');
Route::get('get_sale_return','StorehouseController@getSaleReturn');
Route::post('sale_return_status','StorehouseController@saleReturnStatus');

/*资金管理*/
//购货付款
Route::get('purchasepayment/excel', 'PurchasepaymentController@excel');
Route::get('purchasepayment', 'PurchasepaymentController@index');
Route::get('purchasepayment/create', 'PurchasepaymentController@create');
Route::get('purchasepayment/{purchasepayment}', 'PurchasepaymentController@show');
Route::post('purchasepayment', 'PurchasepaymentController@store');
Route::post('purchasepayment/get_supplier', 'PurchasepaymentController@get_supplier');
Route::post('purchasepayment/get_purchase', 'PurchasepaymentController@get_purchase');
Route::post('purchasepayment/get_details', 'PurchasepaymentController@get_details');
//购货收款
Route::get('purchasereceipts/excel', 'PurchasereceiptsController@excel');
Route::get('purchasereceipts', 'PurchasereceiptsController@index');
Route::get('purchasereceipts/create', 'PurchasereceiptsController@create');
Route::get('purchasereceipts/{purchasereceipts}', 'PurchasereceiptsController@show');
Route::post('purchasereceipts', 'PurchasereceiptsController@store');
Route::post('purchasereceipts/get_supplier', 'PurchasereceiptsController@get_supplier');
Route::post('purchasereceipts/get_purchase', 'PurchasereceiptsController@get_purchase');
Route::post('purchasereceipts/get_details', 'PurchasereceiptsController@get_details');
//销货收款
Route::get('salesreceipts/excel', 'SalesreceiptsController@excel');
Route::get('salesreceipts', 'SalesreceiptsController@index');
Route::get('salesreceipts/create', 'SalesreceiptsController@create');
Route::get('salesreceipts/{salesreceipts}', 'SalesreceiptsController@show');
Route::post('salesreceipts', 'SalesreceiptsController@store');
Route::post('salesreceipts/get_client', 'SalesreceiptsController@get_client');
Route::post('salesreceipts/get_sales', 'SalesreceiptsController@get_sales');
Route::post('salesreceipts/get_details', 'SalesreceiptsController@get_details');
//销货退款
Route::get('salespayment/excel', 'SalespaymentController@excel');
Route::get('salespayment', 'SalespaymentController@index');
Route::get('salespayment/create', 'SalespaymentController@create');
Route::get('salespayment/{salespayment}', 'SalespaymentController@show');
Route::post('salespayment', 'SalespaymentController@store');
Route::post('salespayment/get_client', 'SalespaymentController@get_client');
Route::post('salespayment/get_sales', 'SalespaymentController@get_sales');
Route::post('salespayment/get_details', 'SalespaymentController@get_details');

/** 采购报表*/
//采购明细表
Route::get('procurement_details', 'ProcurementDetailsController@index');
Route::get('procurement_details/excel','ProcurementDetailsController@excel');
//采购汇总表（按照商品）
Route::get('procurement_summary_goods', 'ProcurementSummaryGoodsController@index');
Route::get('procurement_summary_goods/excel','ProcurementSummaryGoodsController@excel');
//采购汇总表（按照供应商）
Route::get('procurement_summary_supplier', 'ProcurementSummarySupplierController@index');
Route::get('procurement_summary_supplier/excel','ProcurementSummarySupplierController@excel');

/** 销货报表*/
//销售明细表
Route::get('sales_details', 'SalesDetailsController@index');
Route::get('sales_details/excel', 'SalesDetailsController@excel');
//销货汇总表（按商品）
Route::get('sales_summary_goods', 'SalesSummaryGoodsController@index');
Route::get('sales_summary_goods/excel', 'SalesSummaryGoodsController@excel');
//销货汇总表（按客户）
Route::get('sales_summary_client', 'SalesSummaryClientController@index');
Route::get('sales_summary_client/excel', 'SalesSummaryClientController@excel');

/**仓库报表*/
//商品库存余额表
Route::get('goods_balance', 'GoodsBalanceController@index');
Route::get('goods_balance/excel', 'GoodsBalanceController@excel');
//商品收发明细表
Route::get('goods_flow_details', 'GoodsFlowDetailsController@index');

/*资金报表*/
Route::get('cash_bank_journal_new', 'CashBankJournalNewController@index');
Route::get('cash_bank_journal_new/excel', 'CashBankJournalNewController@excel');
//应付账款明细表
Route::get('account_pay_detail_new', 'AccountPayDetailsNewController@index');
Route::get('account_pay_detail_new/excel', 'AccountPayDetailsNewController@excel');
//应收账款明细表
Route::get('account_proceeds_detail_new', 'AccountProceedsDetailNewController@index');
Route::get('account_proceeds_detail_new/excel', 'AccountProceedsDetailNewController@excel');
//客户对单
Route::get('customers_reconciliation_new', 'CustomersReconciliationNewController@index');
Route::get('customers_reconciliation_new/excel', 'CustomersReconciliationNewController@excel');
//供应商对单
Route::get('suppliers_reconciliation_new', 'SuppliersReconciliationNewController@index');
Route::get('suppliers_reconciliation_new/excel', 'SuppliersReconciliationNewController@excel');

/*基础资料*/
//客户管理
Route::get('client/excel','ClientController@excel');
Route::post('client/{client}/status','ClientController@status');
Route::post('client/checkUnique','ClientController@checkUnique');
Route::resource('client','ClientController');
//供应商管理
Route::get('suppliermanagement/excel','SuppliermanagementController@excel');
Route::post('suppliermanagement/checkUnique','SuppliermanagementController@checkUnique');
Route::post('suppliermanagement/{suppliermanagement}/status','SuppliermanagementController@status');
Route::resource('suppliermanagement','SuppliermanagementController');
//商品管理
Route::get('goods/excel','GoodsController@excel');
Route::post('goods/{goods}/status','GoodsController@status');
Route::post('goods/checkUnique','GoodsController@checkUnique');
Route::resource('goods','GoodsController');
////仓库管理
Route::post('warehouse/{warehouse}/status','WarehouseController@status');
Route::post('warehouse/checkUnique','WarehouseController@checkUnique');
Route::resource('warehouse','WarehouseController');
//职员管理
Route::post('staff/{staff}/status','StaffController@status');
Route::post('staff/checkUnique','StaffController@checkUnique');
Route::resource('staff','StaffController');
//账户管理
Route::post('account/checkUnique','AccountController@checkUnique');
Route::resource('account','AccountController');

/*辅助资料*/
//客户类别
Route::post('customer/checkUnique','CustomerController@checkUnique');
Route::resource('customer','CustomerController');
//供应商类别
Route::post('supplier/checkUnique','SupplierController@checkUnique');
Route::resource('supplier','SupplierController');
//商品类别
Route::post('commodity/checkUnique','CommodityController@checkUnique');
Route::resource('commodity','CommodityController');
//支出类别
Route::post('expenditure/checkUnique','ExpenditureController@checkUnique');
Route::resource('expenditure','ExpenditureController');
//收入类别
Route::post('income/checkUnique','IncomeController@checkUnique');
Route::resource('income','IncomeController');
//计量单位
Route::post('metering/checkUnique','MeteringController@checkUnique');
Route::resource('metering','MeteringController');
//结算方式cd
Route::post('settlement/checkUnique','SettlementController@checkUnique');
Route::resource('settlement','SettlementController');

//高级设置
Route::get('system_parameter', 'SystemParameterController@index');
Route::post('system_parameter', 'SystemParameterController@update');

Route::get('log','LogController@index');

Route::get('log/test','LogController@test');
//权限设置
Route::get('set_permission/{user_register}', 'UserRegisterController@permission');
Route::post('set_permission', 'UserRegisterController@addPermission');
Route::resource('user_register', 'UserRegisterController');



