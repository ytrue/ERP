<?php $__env->startSection('title', '主页'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo e(\Auth::user()->name); ?>(<?php echo e(\Auth::user()->real_name); ?>)</strong></span>
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

                
                <?php if(\Auth::user()->can('index purchase')||
                      \Auth::user()->can('index purchaseReturns')
                  ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-truck"></i>
                        <span class="nav-label">购货管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index purchase')): ?>
                        <li>
                            <a class="J_menuItem" href="purchase" data-index="0">购货</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index purchaseReturns')): ?>
                        <li>
                            <a class="J_menuItem" href="/purchasereturns" data-index="0">购货退货</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->can('index sale')||
                     \Auth::user()->can('index saleReturn')
                 ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-rocket"></i>
                        <span class="nav-label">销货管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index sale')): ?>
                        <li>
                            <a class="J_menuItem" href="/sales" data-index="0">销货单</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index saleReturn')): ?>
                        <li>
                            <a class="J_menuItem" href="/salereturn" data-index="0">销货退货</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>


                
                <?php if(\Auth::user()->can('index allocation')||
                    \Auth::user()->can('index inventory')||
                    \Auth::user()->can('index getPurchase')||
                    \Auth::user()->can('index getPurchaseReturn')||
                    \Auth::user()->can('index getSales')||
                    \Auth::user()->can('index getSaleReturn')
                ): ?>
               <li>
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">仓库管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index allocation')): ?>
                        <li>
                            <a class="J_menuItem" href="/allocation" data-index="0">调拨单</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index inventory')): ?>
                        <li>
                            <a class="J_menuItem" href="/inventory" data-index="0">仓库盘点</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index getPurchase')): ?>
                        <li>
                            <a class="J_menuItem" href="/get_purchase" data-index="0">购货入库</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index getPurchaseReturn')): ?>
                        <li>
                            <a class="J_menuItem" href="/get_purchase_return" data-index="0">退货出库</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index getSales')): ?>
                        <li>
                            <a class="J_menuItem" href="/get_sales" data-index="0">销货出库</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index getSaleReturn')): ?>
                        <li>
                            <a class="J_menuItem" href="/get_sale_return" data-index="0">退货入库</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->can('index purchasePayment')||
                    \Auth::user()->can('index purchaseReceipts')||
                    \Auth::user()->can('index salesReceipts')||
                    \Auth::user()->can('index salesPayment')
                   ): ?>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-usd"></i>
                        <span class="nav-label">资金管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index purchasePayment')): ?>
                        <li>
                            <a class="J_menuItem" href="/purchasepayment" data-index="0">购货付款</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index purchaseReceipts')): ?>
                        <li>
                            <a class="J_menuItem" href="/purchasereceipts" data-index="0">购货收款</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index salesReceipts')): ?>
                        <li>
                            <a class="J_menuItem" href="/salesreceipts" data-index="0">销货收款</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index salesPayment')): ?>
                        <li>
                            <a class="J_menuItem" href="/salespayment" data-index="0">销货退款</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->can('index procurementSummarySupplier')||
                    \Auth::user()->can('index procurementSummaryGoods')||
                    \Auth::user()->can('index procurementDetails')
                ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">采购报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index procurementDetails')): ?>
                        <li>
                            <a class="J_menuItem" href="/procurement_details" data-index="0">采购明细表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index procurementSummaryGoods')): ?>
                        <li>
                            <a class="J_menuItem" href="/procurement_summary_goods" data-index="0">采购汇总表(按商品)</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index procurementSummarySupplier')): ?>
                        <li>
                            <a class="J_menuItem" href="/procurement_summary_supplier" data-index="0">采购汇总表(按供应商)</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->can('index salesDetails')||
                    \Auth::user()->can('index salesSummaryGoods')||
                    \Auth::user()->can('index salesSummaryClient')
                ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">销售报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index salesDetails')): ?>
                        <li>
                            <a class="J_menuItem" href="/sales_details" data-index="0">销售明细表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index salesSummaryGoods')): ?>
                        <li>
                            <a class="J_menuItem" href="/sales_summary_goods" data-index="0">销售汇总表(按商品)</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index salesSummaryClient')): ?>
                        <li>
                            <a class="J_menuItem" href="/sales_summary_client" data-index="0">销售汇总表(按客户)</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                
                <?php if(\Auth::user()->can('index goodsBalance')||
                      \Auth::user()->can('index goodsBalance')
                  ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">仓库报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index goodsBalance')): ?>
                        <li>
                            <a class="J_menuItem" href="/goods_balance" data-index="0">商品库存余额表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index goodsFlowDetails')): ?>
                        <li>
                            <a class="J_menuItem" href="/goods_flow_details" data-index="0">商品收发明细表</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

            
                <?php if(\Auth::user()->can('index cashBankJournalNew')||
                    \Auth::user()->can('index accountPayDetailNew')||
                    \Auth::user()->can('index accountProceedsDetailNew')||
                    \Auth::user()->can('index customersReconciliationNew')||
                    \Auth::user()->can('index suppliersReconciliationNew')
                ): ?>
               <li>
                    <a href="#">
                        <i class="fa fa-file-excel-o"></i>
                        <span class="nav-label">资金报表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index cashBankJournalNew')): ?>
                        <li>
                            <a class="J_menuItem" href="/cash_bank_journal_new" data-index="0">现金银行报表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index accountPayDetailNew')): ?>
                        <li>
                            <a class="J_menuItem" href="/account_pay_detail_new" data-index="0">应付账款明细表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index accountProceedsDetailNew')): ?>
                        <li>
                            <a class="J_menuItem" href="/account_proceeds_detail_new" data-index="0">应收账款明细表</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index customersReconciliationNew')): ?>
                        <li>
                            <a class="J_menuItem" href="/customers_reconciliation_new" data-index="0">客户对账单</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index suppliersReconciliationNew')): ?>
                        <li>
                            <a class="J_menuItem" href="/suppliers_reconciliation_new" data-index="0">供应商对账单</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->can('index client')||
                     \Auth::user()->can('index supplierManagement')||
                     \Auth::user()->can('index goods')||
                     \Auth::user()->can('index warehouse')||
                     \Auth::user()->can('index staff')||
                      \Auth::user()->can('index account')
                ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-folder-open"></i>
                        <span class="nav-label">基础资料</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index client')): ?>
                        <li>
                            <a class="J_menuItem" href="/client" data-index="0">客户管理</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index supplierManagement')): ?>
                        <li>
                            <a class="J_menuItem" href="/suppliermanagement" data-index="0">供应商管理</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index goods')): ?>
                        <li>
                            <a class="J_menuItem" href="/goods" data-index="0">商品管理</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index warehouse')): ?>
                        <li>
                            <a class="J_menuItem" href="/warehouse" data-index="0">仓库管理</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index staff')): ?>
                        <li>
                            <a class="J_menuItem" href="/staff" data-index="0">职员管理</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index account')): ?>
                        <li>
                            <a class="J_menuItem" href="/account" data-index="0">账户管理</a>
                        </li>
                        <?php endif; ?>
                    </ul>

                </li>
                <?php endif; ?>
                
                <?php if(\Auth::user()->can('index customer')||
                    \Auth::user()->can('index supplier')||
                    \Auth::user()->can('index commodity')||
                    \Auth::user()->can('index expenditure')||
                    \Auth::user()->can('index income')||
                    \Auth::user()->can('index metering')||
                    \Auth::user()->can('index settlement')
                ): ?>
               <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-eye-open"></i>
                        <span class="nav-label">辅助资料</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index customer')): ?>
                        <li>
                            <a class="J_menuItem" href="/customer" data-index="0">客户类别</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index supplier')): ?>
                        <li>
                            <a class="J_menuItem" href="/supplier" data-index="0">供应商类别</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index commodity')): ?>
                        <li>
                            <a class="J_menuItem" href="/commodity" data-index="0">商品类别</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index expenditure')): ?>
                        <li>
                            <a class="J_menuItem" href="/expenditure" data-index="0">支出类别</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index income')): ?>
                        <li>
                            <a class="J_menuItem" href="/income" data-index="0">收入类别</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index metering')): ?>
                        <li>
                            <a class="J_menuItem" href="/metering" data-index="0">计量单位</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index settlement')): ?>
                        <li>
                            <a class="J_menuItem" href="/settlement" data-index="0">结算方式</a>
                        </li>
                        <?php endif; ?>

                    </ul>

                </li>
                <?php endif; ?>
                
                <?php if(\Auth::user()->can('Index index')||
                                   \Auth::user()->can('index user') ||
                                   \Auth::user()->can('index log') ||
                                   \Auth::user()->can('index system')
                                   ): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="nav-label">高级设置</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index system')): ?>
                        <li>
                            <a class="J_menuItem" href="/system_parameter" data-index="0">系统参数</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index user')): ?>
                        <li>
                            <a class="J_menuItem" href="/user_register" data-index="0">权限设置</a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index log')): ?>
                        <li>
                            <a class="J_menuItem" href="/log" data-index="0">操作日志</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <?php echo $__env->make('layouts.right_one', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
     <?php echo $__env->make('layouts.right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--右侧边栏结束-->
</div>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

