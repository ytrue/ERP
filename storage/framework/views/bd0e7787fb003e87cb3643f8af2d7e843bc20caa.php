<?php $__env->startSection('title', '账户管理'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>账户管理</h5>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add account')): ?>
                            <a class="btn btn-info btn-sm " type="button" href="/account/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete account')): ?>
                            <a class="btn btn-danger btn-sm " type="button" url="/account/1" onclick="jumps($(this).attr('url'));"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                            <?php endif; ?>
                            <a class="btn btn-warning btn-sm " type="button" href="/account"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                        </div>

                        <div class="col-sm-3">
                            <form action="/account" method="get">
                                <div class="input-group">
                                    <input type="text" placeholder="请按照账户编号，账户名称查询" class="input-sm form-control" name="search">
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
                                <th class="text-center">账户编号</th>
                                <th class="text-center">账户名称</th>
                                <th class="text-center">当前余额</th>
                                <th class="text-center">初期余额</th>
                                <th class="text-center">创建时间</th>
                                <th class="text-center">账户类别</th>
                                <th class="text-center">操作</th>
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
                                    <td class="text-center"><?php echo e($value->number); ?></td>
                                    <td class="text-center"><?php echo e($value->name); ?></td>
                                    <td class="text-center"><?php echo e($value->current_balance); ?></td>
                                    <td class="text-center"><?php echo e($value->balance); ?></td>
                                    <td class="text-center"><?php echo e($value->created_at); ?></td>
                                    <td class="text-center"><?php echo e($value->type); ?></td>
                                    <td class="text-center">
                                        <a href="/account/<?php echo e($value->id); ?>" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit account')): ?>
                                        <a href="/account/<?php echo e($value->id); ?>/edit" class="btn btn-success btn-sm " type="button"><i class="fa fa-paste"></i> 编辑</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete account')): ?>
                                        <a class="btn btn-danger btn-sm " type="button" url="/account/<?php echo e($value->id); ?>" onclick="jump($(this).attr('url'),<?php echo e($value->id); ?>);"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                                        <?php endif; ?>
                                    </td>
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

