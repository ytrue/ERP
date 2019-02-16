<?php $__env->startSection('title', '仓库盘点'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>仓库盘点</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="table_basic.html#">选项1</a>
                        </li>
                        <li>
                            <a href="table_basic.html#">选项2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9 m-b-xs">
                            <a class="btn btn-primary btn-sm " type="button" href="/inventory/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                            <a class="btn btn-warning btn-sm " type="button" href="/inventory"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                        </div>

                        <div class="col-sm-3">
                            <form action="/inventory" method="get">
                                <div class="input-group">
                                    <select class="form-control m-b test selects"  name="type" id="type">
                                        <option value="all">所有仓库</option>
                                        <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="text-center">
                            <?php if(!empty(session('success'))): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">序号</th>
                                <th class="text-center">仓库</th>
                                <th class="text-center">商品编号</th>
                                <th class="text-center">商品名称</th>
                                <th class="text-center">规格型号</th>
                                <th class="text-center">单位</th>
                                <th class="text-center">系统库存</th>
                                <th class="text-center">库存金额</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="sorting_1">
                                        <div class="text-center">
                                            <input type="checkbox" name="check[]"  yang="yang"  value="<?php echo e($value->id); ?>" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if(isset($_GET['page'])): ?>
                                            <?php echo e(($key+1)+($_GET['page']-1)*2); ?>

                                        <?php else: ?>
                                            <?php echo e(($key+1)+(1-1)*2); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center"><?php echo e($value->warehouse_name); ?></td>
                                    <td class="text-center"><?php echo e($value->number); ?></td>
                                    <td class="text-center"><?php echo e($value->name); ?></td>
                                    <td class="text-center"><?php echo e($value->specification); ?></td>
                                    <td class="text-center"><?php echo e($value->measurement); ?></td>
                                    <td class="text-center"><?php echo e($value->number_count); ?></td>
                                    <td class="text-center"><?php echo e($value->number_count * $value->predicted_price); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <?php echo e($model->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.loading', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

