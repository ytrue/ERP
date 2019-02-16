@section('title', '主页')
@include('layouts.header')
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
<!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">

            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="static/img/profile_small.jpg" /></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{\Auth::user()->name}}({{\Auth::user()->real_name}})</strong></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="profile.html">个人资料</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/logout">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">Yang-ERP
                    </div>
                </li>

                {{--购货--}}
                @if(\Auth::user()->can('index purchase')||
                      \Auth::user()->can('index purchaseReturns')
                  )
                <li>
                    <a href="#">
                        <i class="fa fa-truck"></i>
                        <span class="nav-label">购货管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index purchase')
                        <li>
                            <a class="J_menuItem" href="purchase" data-index="0">购货</a>
                        </li>
                        @endcan
                        @can('index purchaseReturns')
                        <li>
                            <a class="J_menuItem" href="/purchasereturns" data-index="0">购货退货</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{--销货--}}
                @if(\Auth::user()->can('index sale')||
                     \Auth::user()->can('index saleReturn')
                 )
                <li>
                    <a href="#">
                        <i class="fa fa-rocket"></i>
                        <span class="nav-label">销货管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index sale')
                        <li>
                            <a class="J_menuItem" href="/sales" data-index="0">销货单</a>
                        </li>
                        @endcan
                        @can('index saleReturn')
                        <li>
                            <a class="J_menuItem" href="/salereturn" data-index="0">销货退货</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif


                {{--仓库--}}
                @if(\Auth::user()->can('index allocation')||
                    \Auth::user()->can('index inventory')||
                    \Auth::user()->can('index getPurchase')||
                    \Auth::user()->can('index getPurchaseReturn')||
                    \Auth::user()->can('index getSales')||
                    \Auth::user()->can('index getSaleReturn')
                )
               <li>
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">仓库管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index allocation')
                        <li>
                            <a class="J_menuItem" href="/allocation" data-index="0">调拨单</a>
                        </li>
                        @endcan
                        @can('index inventory')
                        <li>
                            <a class="J_menuItem" href="/inventory" data-index="0">仓库盘点</a>
                        </li>
                        @endcan
                        @can('index getPurchase')
                        <li>
                            <a class="J_menuItem" href="/get_purchase" data-index="0">购货入库</a>
                        </li>
                        @endcan
                        @can('index getPurchaseReturn')
                        <li>
                            <a class="J_menuItem" href="/get_purchase_return" data-index="0">退货出库</a>
                        </li>
                        @endcan
                        @can('index getSales')
                        <li>
                            <a class="J_menuItem" href="/get_sales" data-index="0">销货出库</a>
                        </li>
                        @endcan
                        @can('index getSaleReturn')
                        <li>
                            <a class="J_menuItem" href="/get_sale_return" data-index="0">退货入库</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{--资金--}}
                @if(\Auth::user()->can('index purchasePayment')||
                    \Auth::user()->can('index purchaseReceipts')||
                    \Auth::user()->can('index salesReceipts')||
                    \Auth::user()->can('index salesPayment')
                   )
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-usd"></i>
                        <span class="nav-label">资金管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index purchasePayment')
                        <li>
                            <a class="J_menuItem" href="/purchasepayment" data-index="0">购货付款</a>
                        </li>
                        @endcan
                        @can('index purchaseReceipts')
                        <li>
                            <a class="J_menuItem" href="/purchasereceipts" data-index="0">购货收款</a>
                        </li>
                        @endcan
                        @can('index salesReceipts')
                        <li>
                            <a class="J_menuItem" href="/salesreceipts" data-index="0">销货收款</a>
                        </li>
                        @endcan
                        @can('index salesPayment')
                        <li>
                            <a class="J_menuItem" href="/salespayment" data-index="0">销货退款</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{--采购报表--}}
                @if(\Auth::user()->can('index procurementSummarySupplier')||
                    \Auth::user()->can('index procurementSummaryGoods')||
                    \Auth::user()->can('index procurementDetails')
                )
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">采购报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index procurementDetails')
                        <li>
                            <a class="J_menuItem" href="/procurement_details" data-index="0">采购明细表</a>
                        </li>
                        @endcan
                        @can('index procurementSummaryGoods')
                        <li>
                            <a class="J_menuItem" href="/procurement_summary_goods" data-index="0">采购汇总表(按商品)</a>
                        </li>
                        @endcan
                        @can('index procurementSummarySupplier')
                        <li>
                            <a class="J_menuItem" href="/procurement_summary_supplier" data-index="0">采购汇总表(按供应商)</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{--销售报表--}}
                @if(\Auth::user()->can('index salesDetails')||
                    \Auth::user()->can('index salesSummaryGoods')||
                    \Auth::user()->can('index salesSummaryClient')
                )
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">销售报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index salesDetails')
                        <li>
                            <a class="J_menuItem" href="/sales_details" data-index="0">销售明细表</a>
                        </li>
                        @endcan
                        @can('index salesSummaryGoods')
                        <li>
                            <a class="J_menuItem" href="/sales_summary_goods" data-index="0">销售汇总表(按商品)</a>
                        </li>
                        @endcan
                        @can('index salesSummaryClient')
                        <li>
                            <a class="J_menuItem" href="/sales_summary_client" data-index="0">销售汇总表(按客户)</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                {{--仓库报表--}}
                @if(\Auth::user()->can('index goodsBalance')||
                      \Auth::user()->can('index goodsBalance')
                  )
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">仓库报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index goodsBalance')
                        <li>
                            <a class="J_menuItem" href="/goods_balance" data-index="0">商品库存余额表</a>
                        </li>
                        @endcan
                        @can('index goodsFlowDetails')
                        <li>
                            <a class="J_menuItem" href="/goods_flow_details" data-index="0">商品收发明细表</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

            {{--资金报表--}}
                @if(\Auth::user()->can('index cashBankJournalNew')||
                    \Auth::user()->can('index accountPayDetailNew')||
                    \Auth::user()->can('index accountProceedsDetailNew')||
                    \Auth::user()->can('index customersReconciliationNew')||
                    \Auth::user()->can('index suppliersReconciliationNew')
                )
               <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">资金报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index cashBankJournalNew')
                        <li>
                            <a class="J_menuItem" href="/cash_bank_journal_new" data-index="0">现金银行报表</a>
                        </li>
                        @endcan
                        @can('index accountPayDetailNew')
                        <li>
                            <a class="J_menuItem" href="/account_pay_detail_new" data-index="0">应付账款明细表</a>
                        </li>
                        @endcan
                        @can('index accountProceedsDetailNew')
                        <li>
                            <a class="J_menuItem" href="/account_proceeds_detail_new" data-index="0">应收账款明细表</a>
                        </li>
                        @endcan
                        @can('index customersReconciliationNew')
                        <li>
                            <a class="J_menuItem" href="/customers_reconciliation_new" data-index="0">客户对账单</a>
                        </li>
                        @endcan
                        @can('index suppliersReconciliationNew')
                        <li>
                            <a class="J_menuItem" href="/suppliers_reconciliation_new" data-index="0">供应商对账单</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{--基础资料--}}
                @if(\Auth::user()->can('index client')||
                     \Auth::user()->can('index supplierManagement')||
                     \Auth::user()->can('index goods')||
                     \Auth::user()->can('index warehouse')||
                     \Auth::user()->can('index staff')||
                      \Auth::user()->can('index account')
                )
                <li>
                    <a href="#">
                        <i class="fa fa-folder-open"></i>
                        <span class="nav-label">基础资料</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index client')
                        <li>
                            <a class="J_menuItem" href="/client" data-index="0">客户管理</a>
                        </li>
                        @endcan
                        @can('index supplierManagement')
                        <li>
                            <a class="J_menuItem" href="/suppliermanagement" data-index="0">供应商管理</a>
                        </li>
                        @endcan
                        @can('index goods')
                        <li>
                            <a class="J_menuItem" href="/goods" data-index="0">商品管理</a>
                        </li>
                        @endcan
                        @can('index warehouse')
                        <li>
                            <a class="J_menuItem" href="/warehouse" data-index="0">仓库管理</a>
                        </li>
                        @endcan
                        @can('index staff')
                        <li>
                            <a class="J_menuItem" href="/staff" data-index="0">职员管理</a>
                        </li>
                        @endcan
                        @can('index account')
                        <li>
                            <a class="J_menuItem" href="/account" data-index="0">账户管理</a>
                        </li>
                        @endcan
                    </ul>

                </li>
                @endif
                {{--辅助资料--}}
                @if(\Auth::user()->can('index customer')||
                    \Auth::user()->can('index supplier')||
                    \Auth::user()->can('index commodity')||
                    \Auth::user()->can('index expenditure')||
                    \Auth::user()->can('index income')||
                    \Auth::user()->can('index metering')||
                    \Auth::user()->can('index settlement')
                )
               <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-eye-open"></i>
                        <span class="nav-label">辅助资料</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index customer')
                        <li>
                            <a class="J_menuItem" href="/customer" data-index="0">客户类别</a>
                        </li>
                        @endcan
                        @can('index supplier')
                        <li>
                            <a class="J_menuItem" href="/supplier" data-index="0">供应商类别</a>
                        </li>
                        @endcan
                        @can('index commodity')
                        <li>
                            <a class="J_menuItem" href="/commodity" data-index="0">商品类别</a>
                        </li>
                        @endcan
                        @can('index expenditure')
                        <li>
                            <a class="J_menuItem" href="/expenditure" data-index="0">支出类别</a>
                        </li>
                        @endcan
                        @can('index income')
                        <li>
                            <a class="J_menuItem" href="/income" data-index="0">收入类别</a>
                        </li>
                        @endcan
                        @can('index metering')
                        <li>
                            <a class="J_menuItem" href="/metering" data-index="0">计量单位</a>
                        </li>
                        @endcan
                        @can('index settlement')
                        <li>
                            <a class="J_menuItem" href="/settlement" data-index="0">结算方式</a>
                        </li>
                        @endcan

                    </ul>

                </li>
                @endif
                {{--高级设置--}}
                @if(\Auth::user()->can('Index index')||
                                   \Auth::user()->can('index user') ||
                                   \Auth::user()->can('index log') ||
                                   \Auth::user()->can('index system')
                                   )
                <li>
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="nav-label">高级设置</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('index system')
                        <li>
                            <a class="J_menuItem" href="/system_parameter" data-index="0">系统参数</a>
                        </li>
                        @endcan
                        @can('index user')
                        <li>
                            <a class="J_menuItem" href="/user_register" data-index="0">权限设置</a>
                        </li>
                        @endcan
                        @can('index log')
                        <li>
                            <a class="J_menuItem" href="/log" data-index="0">操作日志</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    @include('layouts.right_one')
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
     @include('layouts.right')
    <!--右侧边栏结束-->
</div>
@include('layouts.footer')

