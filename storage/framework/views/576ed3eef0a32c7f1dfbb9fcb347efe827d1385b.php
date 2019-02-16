<?php $__env->startSection('title', '客户退货订单'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>客户退货订单</h5>
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
                        <form action="/get_sale_return" method="get" class="col-sm-12">
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
                                    <select class="form-control m-b" name="client">
                                        <option></option>
                                        <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" value="" name="status">

                            <div class="form-group" style="width: 395px">
                                <label>销售人员：</label>
                                <div>
                                    <select class="form-control m-b" name="staff">
                                        <option></option>
                                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group" style="width: 395px">
                                <label>出入状态：</label>
                                <div>
                                    <select class="form-control m-b" name="status">
                                        <option></option>
                                        <option value="1">未入库</option>
                                        <option value="2">已入库</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group" style="width: 395px">
                                <label>单据编号：</label>
                                <div>
                                    <input type="text" class="form-control" name="document_number" placeholder="请输入单据编号">
                                </div>
                            </div>



                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                    <a class="btn btn-info btn-sm " type="button" href="/get_sale_return/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                    <a class="btn btn-warning btn-sm " type="button" href="/get_sale_return"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
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
                                <th class="text-center">客户</th>
                                <th class="text-center">销售人员</th>
                                <th class="text-center">销货金额</th>
                                <th class="text-center">优惠后金额</th>
                                <th class="text-center">已退款款</th>
                                <th class="text-center">退款状态</th>
                                <th class="text-center">制单人</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status getSaleReturn')): ?>
                                <th class="text-center">入库状态</th>
                                <?php endif; ?>
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
                                    <td class="text-center"><?php echo e($value->document_number); ?></td>
                                    <td class="text-center"><?php echo e($value->getClient->name); ?></td>
                                    <td class="text-center"><?php echo e($value->getStaff->name); ?></td>
                                    <td class="text-center">
                                        <?php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getSaleReturnExtend); $i++){
                                                 $number+=$value->getSaleReturnExtend[$i]->purchase_amount;
                                             }
                                             echo $number;
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <?php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getSaleReturnExtend); $i++){
                                                 $number+=$value->getSaleReturnExtend[$i]->purchase_amount;
                                             }
                                             if ($value->preferential_rate == 0){
                                                echo $number;
                                             }else{
                                                $preferential_rate = ($value->preferential_rate/100);
                                                echo  $number*$preferential_rate;
                                             }
                                        ?>
                                    </td>

                                    <td class="text-center"><?php echo e($value->paid); ?></td>

                                    <td class="text-center">
                                        <?php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getSaleReturnExtend); $i++){
                                                 $number+=$value->getSaleReturnExtend[$i]->purchase_amount;
                                            }
                                            if ($value->preferential_rate == 0){
                                                 $number;
                                            }else{
                                                $preferential_rate = ($value->preferential_rate/100);
                                                $number =  $number*$preferential_rate;
                                            }

                                            if ($value->paid==0){
                                                echo '未退款';
                                            }else if($value->paid < $number){
                                                echo '部分退款';
                                            }else if($value->paid == $number){
                                                echo '已退完全款';
                                            }
                                        ?>
                                    </td>

                                    <td class="text-center"><?php echo e($value->user_name); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status getSaleReturn')): ?>
                                    <td class="text-center"><a url="/sale_return_status" onclick="set_status($(this).attr('url'),this,<?php echo e($value->id); ?>)"><?php echo $value->status; ?></a></td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <a href="/salereturn/<?php echo e($value->id); ?>" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
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
<?php $__env->startSection('extend-js'); ?>
    <script>
        function set_status(url,thiss,id) {
            $.ajax({
                url:url,
                type:'POST',
                data:{
                    id:id
                },
                beforeSend:function(){
                    $('#ok').modal('show');
                },
                success:function (r,s,x) {
                    if (r == '1'){

                        $('#ok-img').attr('src','../images/jump_error.png');
                        $('#ok-text').html('数据已入库,请勿重复操作!');
                        setTimeout(function () {
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        },1000);
                    }else if (r == '2'){
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据修改成功');
                        setTimeout(function () {
                            $(thiss).html('<span class="label label-primary">已入库</span>');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        },100);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

