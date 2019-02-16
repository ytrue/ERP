<?php $__env->startSection('title', '商品库存余额表'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品库存余额表</h5>
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
                        <div>
                            <form action="/goods_balance" method="get" class="col-sm-12">


                                <div class="form-group" style="width: 395px">
                                    <label>仓库：</label>
                                    <div>
                                        <select class="form-control m-b" name="warehouse">
                                            <option></option>
                                            <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>商品：</label>
                                    <div>
                                        <select class="form-control m-b" name="goods">
                                            <option></option>
                                            <?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                        <a class="btn btn-info btn-sm " type="button" href="/goods_balance/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                        <a class="btn btn-warning btn-sm " type="button" href="/goods_balance"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center" rowspan="2">商品编号</td>
                                <td class="text-center" rowspan="2">商品名称</td>
                                <td class="text-center" rowspan="2">规格型号</td>
                                <td class="text-center" rowspan="2">单位</td>
                                <td colspan="2" class="text-center" >所有仓库</td>
                                <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="text-center" ><?php echo e($value->name); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>

                             <tr>
                                <td class="text-center" >成本</td>
                                <td  class="text-center">数量</td>
                                <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-center" >数量</td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>

                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($value['goodsNumber']); ?></td>
                                <td class="text-center"><?php echo e($value['goodsName']); ?></td>
                                <td class="text-center"><?php echo e($value['goodsSpecification']); ?></td>
                                <td class="text-center"><?php echo e($value['measurement']); ?></td>
                                <td class="text-center"><?php echo e($value['goodsCost']); ?></td>
                                <td class="text-center"><?php echo e($value['goodsSum']); ?></td>

                                <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wKey => $wValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-center">
                                        <?php $__currentLoopData = $value['warehouses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($v['warehouse_id'] == $wValue->id): ?>
                                                    <?php echo e($v['number']); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

