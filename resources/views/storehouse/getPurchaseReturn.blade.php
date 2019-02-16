@section('title', '购货退货出库')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>购货退货出库</h5>
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
                        <form action="/get_purchase_return" method="get" class="col-sm-12">
                            <div class="form-group" id="data_5">
                                <label>日期：</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="background: white" readonly name="start_date">
                                    <span class="input-group-addon">到</span>
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" readonly  style="background: white" name="end_date">
                                </div>
                            </div>

                            <div class="form-group" style="width: 395px">
                                <label>供应商：</label>
                                <div>
                                    <select class="form-control m-b" name="supplierManagement">
                                        <option></option>
                                        @foreach($supplierManagement as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
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
                                    <a class="btn btn-info btn-sm " type="button" href="/get_purchase_return/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                    <a class="btn btn-warning btn-sm " type="button" href="/get_purchase_return"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="text-center">
                            @if(!empty(session('success')))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">序号</th>
                                <th class="text-center">单据日期</th>
                                <th class="text-center">单据编号</th>
                                <th class="text-center">供应商</th>
                                <th class="text-center">退货金额</th>
                                <th class="text-center">优惠后金额</th>
                                <th class="text-center">已退款</th>
                                <th class="text-center">退款状态</th>
                                <th class="text-center">制单人</th>
                                @can('status getPurchaseReturn')
                                <th class="text-center">出库状态</th>
                                @endcan
                                <th class="text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key => $value)
                                <tr>
                                    <td class="sorting_1">
                                        <div class="text-center">
                                            <input type="checkbox" name="check[]" yang="yang" value="{{$value->id}}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if(isset($_GET['page']))
                                            {{($key+1)+($_GET['page']-1)*2}}
                                        @else
                                            {{($key+1)+(1-1)*2}}
                                        @endif
                                    </td>
                                    <td class="text-center">{{$value->created_at}}</td>
                                    <td class="text-center">{{$value->document_number}}</td>
                                    <td class="text-center">{{$value->getSupplierManagement->name}}</td>

                                    <td class="text-center">
                                        @php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getPurchasereturnExtend); $i++){
                                                 $number+=$value->getPurchasereturnExtend[$i]->purchase_amount;
                                             }
                                             echo $number;
                                        @endphp
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getPurchasereturnExtend); $i++){
                                                 $number+=$value->getPurchasereturnExtend[$i]->purchase_amount;
                                             }
                                             if ($value->preferential_rate == 0){
                                                echo $number;
                                             }else{
                                                $preferential_rate = ($value->preferential_rate/100);
                                                echo  $number*$preferential_rate;
                                             }
                                        @endphp
                                    </td>
                                    <td class="text-center">{{$value->paid}}</td>
                                    <td class="text-center">
                                        @php
                                            $number = 0;
                                            for ($i = 0; $i <sizeof($value->getPurchasereturnExtend); $i++){
                                                 $number+=$value->getPurchasereturnExtend[$i]->purchase_amount;
                                            }
                                             if ($value->preferential_rate == 0){
                                                  $number;
                                             }else{
                                                $preferential_rate = ($value->preferential_rate/100);
                                                $number =  $number*$preferential_rate;
                                             }
                                            if ($value->paid==0){
                                                echo '未退款';
                                            }else if ($value->paid < $number){
                                                echo '部分退款';
                                            }else if($value->paid == $number){
                                                echo '已全部退款';
                                            }
                                        @endphp
                                    </td>
                                    <td class="text-center">{{$value->user_name}}</td>
                                    @can('status getPurchaseReturn')
                                    <td class="text-center"><a url="/purchase_return_status"
                                                               onclick="set_status($(this).attr('url'),this,{{$value->id}})">{!!$value->status !!}</a>
                                    </td>
                                    @endcan
                                    <td class="text-center">
                                        <a href="/purchasereturns/{{$value->id}}" class="btn btn-primary btn-sm "
                                           type="button"><i class="fa fa-money"></i> 查看</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@section('extend-js')
    <script>
        function set_status(url, thiss, id) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                },
                success: function (r, s, x) {
                    if (r == '1') {

                        $('#ok-img').attr('src', '../images/jump_error.png');
                        $('#ok-text').html('数据已出库,请勿重复操作!');
                        setTimeout(function () {
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src', '../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        }, 1000);
                    } else if (r == '2') {
                        $('#ok-img').attr('src', '../images/jump_success.png');
                        $('#ok-text').html('数据修改成功');
                        setTimeout(function () {
                            $(thiss).html('<span class="label label-primary">已出库</span>');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src', '../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        }, 100);
                    }
                }
            })
        }
    </script>
@endsection
@include('layouts.footer')

