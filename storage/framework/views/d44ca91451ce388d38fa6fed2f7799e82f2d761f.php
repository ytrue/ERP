<?php $__env->startSection('title', '权限设置'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/supplier">权限设置 </a> /  <?php echo e($user->name); ?>(<?php echo e($user->real_name); ?>)
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>Q
                            <a href="form_basic.html#">选项1</a>
                        </li>
                        <li>
                            <a href="form_basic.html#">选项2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div method="post" class="form-horizontal"  action="/user_register" id="reg">
                    <h3>首页</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">首页</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline ">
                                <input type="checkbox" value="index index" checked>首页</label>
                        </div>
                    </div>
                    <h3>辅助资料</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">结算方式</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline ">
                                <input type="checkbox" value="index settlement">结算方式主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add settlement">新增结算方式</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit settlement">编辑结算方式</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete settlement">删除结算方式</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">计量单位</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index metering">计量单位主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add metering">新增计量单位</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit metering">编辑计量单位</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete metering">删除计量单位</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">收入类别</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index income">收入类别主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add income">新增收入类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit income">编辑收入类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete income">删除收入类别</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">支出类别</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index expenditure">支出类别主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add expenditure">新增支出类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit expenditure">编辑支出类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete expenditure">删除支出类别</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品类别</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index commodity">商品类别主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add commodity">新增商品类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit commodity">编辑商品类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete commodity">删除商品类别</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商类别</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index supplier">供应商类别主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add supplier">新增供应商类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit supplier">编辑供应商类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete supplier">删除供应商类别</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户类别</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index customer">客户类别主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add customer">新增客户类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit customer">编辑客户类别</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete customer">删除客户类别</label>
                        </div>
                    </div>
                    <hr>
                    <h3>基础资料</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账户管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index account">账户管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add account">新增账户</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit account">编辑账户</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete account">删除账户</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">职员管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index staff">职员管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add staff">新增职员</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit staff">编辑职员</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status staff">职员状态的修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete staff">删除职员</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">仓库管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index warehouse">仓库管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add warehouse">新增仓库</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit warehouse">编辑仓库</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status warehouse">仓库状态的修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete warehouse">删除仓库</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index goods">商品管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add goods">新增商品</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit goods">编辑商品</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status goods">商品状态的修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete goods">删除商品</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index supplierManagement">供应商管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add supplierManagement">新增供应商</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit supplierManagement">编辑供应商</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status supplierManagement">供应商状态的修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete supplierManagement">删除供应商</label>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户管理</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index client">客户管理主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add client">新增客户</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit client">编辑客户</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status client">客户状态的修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete client">删除客户</label>
                        </div>
                    </div>

                    <hr>
                    <h3>资金报表</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商对账单</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index suppliersReconciliationNew"  >供应商对账单主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户对账单</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index customersReconciliationNew" >客户对账单主页</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">应收账款明细表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index accountProceedsDetailNew" >应收账款明细表主页</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">应付账款明细表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index accountPayDetailNew"  >应付账款明细表主页</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">现金银行报表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index cashBankJournalNew" >现金银行报表主页</label>
                        </div>
                    </div>

                    <hr>
                    <h3>仓库报表</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品收发明细表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index goodsFlowDetails" >商品库存余额表主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品库存余额表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index goodsBalance" >商品库存余额表主页</label>
                        </div>
                    </div>

                    <hr>
                    <h3>销售报表</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">销售汇总表(按客户)</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index salesSummaryClient" >销售汇总表(按客户)主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">销售汇总表(按商品)</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index salesSummaryGoods" >销售汇总表(按商品)主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">销售明细表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index salesDetails" >销售明细表主页</label>
                        </div>
                    </div>

                    <hr>
                    <h3>采购报表</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">采购汇总表(按供应商)</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index procurementSummarySupplier" >采购汇总表(按供应商)主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">采购汇总表(按商品)</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index procurementSummaryGoods" >采购汇总表(按商品)主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">采购明细表</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index procurementDetails" >采购明细表主页</label>
                        </div>
                    </div>

                    <hr>
                    <h3>资金管理</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">销货退款</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index salesPayment">销货退款主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add salesPayment">销货退款</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">销货收款</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index salesReceipts">销货收款主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add salesReceipts">销货收款</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">购货收款</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index purchaseReceipts">购货收款主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add purchaseReceipts">购货收款</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">购货付款</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index purchasePayment">购货付款主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add purchasePayment">购货付款</label>
                        </div>
                    </div>


                    <hr>
                    <h3>仓库管理</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">退货入库</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index getSaleReturn">退货入库主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status getSaleReturn">退货入库</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">销货出库</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index getSales">销货出库主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status getSales">销货出库</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">退货出库</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index getPurchaseReturn">退货出库主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status getPurchaseReturn">退货出库</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">购货入库</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index getPurchase">购货入库主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status getPurchase">购货入库</label>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label">仓库盘点</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index inventory">仓库盘点主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">调拨单</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index allocation">调拨单主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add allocation">仓库调拨</label>
                        </div>
                    </div>

                    <hr>
                    <h3>销货管理</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">销货退货</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index saleReturn">销货退货主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add saleReturn">销货退货</label>
                        </div>
                    </div>

                    <h3>销货管理</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">销货</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index sale">销货主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add sale">销货</label>
                        </div>
                    </div>

                    <h3>购货管理</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">购货退货</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index purchaseReturns">购货退货主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add purchaseReturns">购货退货</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">购货</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index purchase">购货主页</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="add purchase">购货</label>
                        </div>
                    </div>

                    <h3>高级设置</h3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">系统日志</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index log">系统日志主页</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">权限设置</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index user">主页</label>

                            <label class="checkbox-inline">
                                <input type="checkbox" value="add user">用户新增</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="edit user">用户修改</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="delete user">用户删除</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="status user">用户审核</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="user permission">功能授权</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">系统参数</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="index system">系统参数主页</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="submit">保存内容</button>
                            <a onclick="window.history.go(-1);" class="btn btn-white" type="submit">取消</a>
                        </div>
                    </div>

                    <input type="hidden" value="<?php echo e($user->id); ?>" id="user_id">

                </div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.loading', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('extend-js'); ?>
    <script>
        var json_data = [];
        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            json_data["<?php echo e($key); ?>"] = '{"name":"<?php echo e($value); ?>"}';
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        var data = [];

        for (var i = 0; i < json_data.length; i++){
            data[i] = JSON.parse(json_data[i]);
        }

        for (var j = 0; j < data.length; j++){
            for (var i = 0; i < $("input[type='checkbox']").length; i++){
                if (data[j]['name'] == $("input[type='checkbox']").eq(i).val()){
                    $("input[type='checkbox']").eq(i).prop("checked",true);
                }
            }
        }

       // alert($("input[type='checkbox']:checkbox:checked").length)
        $("#submit").click(function () {
            var permissionData = [];
            for (var j = 0; j < $("input[type='checkbox']:checkbox:checked").length; j++){
                permissionData[j] = $("input[type='checkbox']:checkbox:checked").eq(j).val();
            }

            if (permissionData.length == 0) {
                swal({title: "error", text: "请先选择权限", type: "error"})
            }else {
                 $.ajax({
                    type:'post',
                    url:'/set_permission',
                    data:{
                        permission:JSON.stringify(permissionData),
                        user_id:$("#user_id").val()
                    },
                     beforeSend: function () {
                         $('#ok').modal('show');
                     },
                     success: function (r, x, s) {
                        if (r == 'true'){
                            $('#ok-img').attr('src', '../images/jump_success.png');
                            $('#ok-text').html('数据添加成功');
                            setTimeout(function () {
                                window.location.href = "/user_register";
                            }, 100);
                        }
                     }

                 });
            }


        })



    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

