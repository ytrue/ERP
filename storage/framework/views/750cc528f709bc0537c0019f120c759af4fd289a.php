<?php $__env->startSection('title', '修改仓库管理'); ?>
<?php echo $__env->make('layouts.header-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/warehouse">仓库管理 </a> / <?php echo e($warehouse->name); ?> - 修改
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
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
                <form method="post" class="form-horizontal"  action="/warehouse/<?php echo e($warehouse->id); ?>" id="reg">
                    <?php echo e(method_field("PUT")); ?>

                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" value="<?php echo e($warehouse->id); ?>" id="warehouse_id" name="id">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">仓库编号</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number" value="<?php echo e($warehouse->number); ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">仓库名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo e($warehouse->name); ?>">
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
<?php $__env->startSection('extend-js'); ?>
    <script src="../../js/warehouse.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.footer-edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

