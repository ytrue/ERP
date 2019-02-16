<?php $__env->startSection('title', '用户注册'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/supplier">用户注册 </a> /  新增
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
                <form method="post" class="form-horizontal"  action="/user_register" id="reg">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">确认密码</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">真实姓名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="real_name" id="real_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">email</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">常用手机</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
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
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

