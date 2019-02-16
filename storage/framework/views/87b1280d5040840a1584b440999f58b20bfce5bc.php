<?php $__env->startSection('title', '新增客户管理'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/suppliermanagement">客户管理 </a> /  新增
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
                <form method="post" class="form-horizontal"  action="/suppliermanagement" id="reg">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户编号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户类别</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="type" id="type">
                                <option></option>
                                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->name); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户等级</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="level" id="level">
                                <option></option>
                                <option value="零售客户">零售客户</option>
                                <option value="批发客户">批发客户</option>
                                <option value="VIP客户">VIP客户</option>
                                <option value="折扣等级一">折扣等级一</option>
                                <option value="折扣等级二">折扣等级二</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">余额日期</label>
                        <div class="col-sm-10">
                            <input name="balance_date" id="balance_date" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初应付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_payable" id="initial_payable">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初预付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_advance_payment" id="initial_advance_payment">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts" id="contacts">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">座机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="landline" id="landline">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ/MSN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="qq" id="qq">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">配送地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述简介</label>
                        <div class="col-sm-10">
                            <textarea  class="form-control" name="info" id="info" placeholder="描述简介..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">保存内容</button>
                            <a onclick="window.history.go(-1);" class="btn btn-white" type="submit">取消</a>
                        </div>
                    </div>
                </form>
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
    <script src="../js/client.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

