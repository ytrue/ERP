<?php $__env->startSection('title', '购货退货详情'); ?>
<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/purchasereturn">购货退货管理 </a> /  <?php echo e($purchasereturn->document_number); ?>  - 详情
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
                <div    class="form-horizontal" >

                    <div class="ibox-content" >
                        <table class="table table-bordered text-center">
                            <thead>
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class=" input-group">
                                        <input type="text" class="form-control " id="gys_name" disabled  style="width: 250px;" value="<?php echo e($purchasereturn->getSupplierManagement->name); ?>" >
                                    </div>
                                </div>
                            </div>
                            <tr>
                                <th class="text-center">商品</th>
                                <th class="text-center">单位</th>
                                <th class="text-center">仓库</th>
                                <th class="text-center">数量</th>
                                <th class="text-center">购货单价</th>
                                <th class="text-center">折扣率</th>
                                <th class="text-center">折扣额</th>
                                <th class="text-center">购货金额</th>
                            </tr>
                            </thead>
                            <tbody id="add_row">
                            <?php $__currentLoopData = $purchasereturn->getPurchasereturnExtend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width: 200px;">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php echo e($value->getGoods->name); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td style="width: 100px;">
                                        <div class="company">
                                            <?php echo e($value->company); ?>

                                        </div>
                                    </td>

                                    <td style="width: 200px;">
                                        <div class="col-sm-12">
                                            <?php echo e($value->getWarehouse->name); ?>

                                        </div>
                                    </td>

                                    <td style="width: 100px;">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php echo e($value->number); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td style="width: 100px;">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php echo e($value->unit_purchase_price); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td style="width: 100px;">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php echo e($value->discount_rate); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td style="width: 100px;">
                                        <div class="zke">
                                            <?php
                                                if ($value->discount_rate == 0){
                                                    echo $value->purchase_amount - $value->purchase_amount;
                                                }else{
                                                    echo $value->purchase_amount - $value->purchase_amount * ($value->discount_rate/100);
                                                }
                                            ?>
                                        </div>
                                    </td>

                                    <td style="width: 100px;"  >
                                        <div class="purchase_amount">
                                            <?php echo e($value->purchase_amount); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center" style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="col-sm-4">总数量：<span id="sum_number">
                                              <?php
                                                  $number = 0;
                                                  for ($i = 0; $i <sizeof($purchasereturn->getPurchasereturnExtend); $i++){
                                                       $number+=$purchasereturn->getPurchasereturnExtend[$i]->number;
                                                   }
                                                   echo $number;
                                              ?>
                                        </span>
                                    </div>
                                    <div class="col-sm-4">折扣额：<span id="sum_zke">
                                        </span></div>
                                    <div class="col-sm-4">购货总金额：<span id="sum_purchase_amount">
                                             <?php
                                                 $number = 0;
                                                 for ($i = 0; $i <sizeof($purchasereturn->getPurchasereturnExtend); $i++){
                                                      $number+=$purchasereturn->getPurchasereturnExtend[$i]->purchase_amount;
                                                  }
                                                  echo $number;
                                             ?>
                                        </span></div>
                                </th>
                            </tr>
                            <tr>
                                <td style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea  class="form-control" disabled placeholder="简介..."><?php echo e($purchasereturn->details); ?></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">优惠率:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="test01"  value="<?php echo e($purchasereturn->preferential_rate); ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">优惠金额:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="yhje" id="yhje" disabled="disabled" value="0">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">优惠后金额:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control text-left" name="yhhje" id="yhhje" disabled="disabled">
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">本次付款</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="test03" value="<?php echo e($purchasereturn->paid); ?>" disabled="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">结算账户:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" disabled="disabled" value="<?php echo e($purchasereturn->getAccount->name); ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-sm-5 control-label">本次欠款:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="bcqk" id="bcqk" disabled>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                            </tfoot>
                        </table>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a onclick="window.history.go(-1);" class="btn btn-primary" type="submit">返回上一层</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('extend-js'); ?>
    <script>
        var length = $(".zke").length;
        var number = 0;
        for (var i = 0; i < length; i++){
            number+=parseFloat($(".zke").eq(i).text());
        }

        $("#sum_zke").html(number);


        var sum_purchase_amount = $("#sum_purchase_amount").html();  //购货总金额
        var test01 = $("#test01").val();   //优惠率


        var test03 = $("#test03").val();
        if (test01 == 0){
            var test02 =sum_purchase_amount;
            test02 =trim(test02)
        }else {
            var test02 =(test01/100)*sum_purchase_amount;
        }
        $("#yhhje").val(test02);
        $("#yhje").val(sum_purchase_amount - test02);
        $("#bcqk").val(test02-test03);

        function trim(str){ //删除左右两端的空格
            return str.replace(/(^\s*)|(\s*$)/g, "");
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
