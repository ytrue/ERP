<?php $__env->startSection('title', '销货退款'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>销货退款</h5>
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
                        <form action="/salespayment" method="get" class="col-sm-12">
                            <div class="form-group" id="data_5">
                                <label>日期：</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="background: white" readonly name="start_date">
                                    <span class="input-group-addon">到</span>
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" readonly  style="background: white" name="end_date">
                                </div>
                            </div>

                            <div class="form-group" style="width: 395px">
                                <label>客户：</label>
                                <div>
                                    <select class="form-control m-b" name="unit">
                                        <option></option>
                                        <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="">
                            <div class="form-group" style="width: 395px">
                                <label>单据编号：</label>
                                <div>
                                    <input type="text" class="form-control" name="document_number" placeholder="请输入单据编号">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add salesPayment')): ?>
                                    <a class="btn btn-info btn-sm " type="button" href="/salespayment/create"><i class="glyphicon glyphicon-plus"></i> 付款</a>
                                    <?php endif; ?>
                                    <a class="btn btn-info btn-sm " type="button" href="/salespayment/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                    <a class="btn btn-warning btn-sm " type="button" href="/salespayment"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                </div>
                            </div>
                        </form>

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
                                <th class="text-center">单据日期</th>
                                <th class="text-center">单据编号</th>
                                <th class="text-center">销货单位</th>
                                <th class="text-center">收款总金额</th>
                                <th class="text-center">制单人</th>
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
                                    <td class="text-center"><?php echo e($value->created_at); ?></td>
                                    <td class="text-center"><?php echo e($value->ood_number); ?></td>
                                    <td class="text-center"><?php echo e($value->getClient->name); ?></td>
                                    <td class="text-center">
                                        <?php
                                            $number = 0;
                                            foreach ($value->getPaymentExtend as $k => $v){
                                                $number+= $v->payment_amount;
                                            }
                                            echo  sprintf("%.2f",$number);
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo e($value->getUser->name); ?></td>
                                    <td class="text-center">
                                        <a href="/salespayment/<?php echo e($value->id); ?>" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
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

