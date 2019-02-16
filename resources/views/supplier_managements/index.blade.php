@section('title', '供应商管理')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>供应商管理</h5>
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
                            @can('add supplierManagement')
                            <a class="btn btn-info btn-sm " type="button" href="/suppliermanagement/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            @endcan
                            <a class="btn btn-primary btn-sm " type="button" href="/suppliermanagement/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                            @can('delete supplierManagement')
                            <a class="btn btn-danger btn-sm " type="button" url="/suppliermanagement/1" onclick="jumps($(this).attr('url'));"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                            @endcan
                            <a class="btn btn-warning btn-sm " type="button" href="/suppliermanagement"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>

                        </div>

                        <div class="col-sm-3">
                            <form action="/suppliermanagement" method="get">
                                <div class="input-group">
                                    <input type="text" placeholder="请按照供应商编号，供应商名称,供应商类别查询" class="input-sm form-control" name="search">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
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
                                <th class="text-center">供应商类别</th>
                                <th class="text-center">供应商编号</th>
                                <th class="text-center">供应商名称</th>
                                <th class="text-center">联系人名称</th>
                                <th class="text-center">手机号码</th>
                                <th class="text-center">座机号码</th>
                                <th class="text-center">QQ\MSN</th>
                                <th class="text-center">初期往余额</th>
                                @can('status supplierManagement')
                                <th class="text-center">状态</th>
                                @endcan
                                <th class="text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key => $value)
                                <tr>
                                    <td class="sorting_1">
                                        <div class="text-center">
                                            <input type="checkbox" name="check[]"  yang="yang"  value="{{$value->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if(isset($_GET['page']))
                                            {{($key+1)+($_GET['page']-1)*2}}
                                        @else
                                            {{($key+1)+(1-1)*2}}
                                        @endif
                                    </td>
                                    <td class="text-center">{{$value->type}}</td>
                                    <td class="text-center">{{$value->number}}</td>
                                    <td class="text-center">{{$value->name}}</td>
                                    <td class="text-center">{{$value->getSupplierManagementExtend['contacts']}}</td>
                                    <td class="text-center">{{$value->getSupplierManagementExtend['phone']}}</td>
                                    <td class="text-center">{{$value->getSupplierManagementExtend['landline']}}</td>
                                    <td class="text-center">{{$value->getSupplierManagementExtend['qq']}}</td>
                                    <td class="text-center">{{$value->initial_payable - $value->initial_advance_payment}}</td>
                                    @can('status supplierManagement')
                                    <td class="text-center"><a url="/suppliermanagement/{{$value->id}}/status" onclick="set_status($(this).attr('url'),this)">{!!$value->status !!}</a></td>
                                    @endcan
                                    <td class="text-center">
                                        <a href="/suppliermanagement/{{$value->id}}" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
                                        @can('edit supplierManagement')
                                        <a href="/suppliermanagement/{{$value->id}}/edit" class="btn btn-success btn-sm " type="button"><i class="fa fa-paste"></i> 编辑</a>
                                        @endcan
                                        @can('delete supplierManagement')
                                        <a class="btn btn-danger btn-sm " type="button" url="/suppliermanagement/{{$value->id}}" onclick="jump($(this).attr('url'),{{$value->id}});"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                         {{$model->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@section('extend-js')
    <script>
        function set_status(url,thiss) {
            $.ajax({
                url:url,
                type:'POST',
                beforeSend:function(){
                    $('#ok').modal('show');
                },
                success:function (r,s,x) {
                    if (r == '1'){
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据修改成功');
                        setTimeout(function () {
                            $(thiss).html('<span class="label label-primary">已启动</span>');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        },100);
                    }else if (r == '2'){
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据修改成功');
                        setTimeout(function () {
                            $(thiss).html('<span class="label label-danger">已禁用</span>');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中...');
                        },100);
                    }
                }
            })
        }
    </script>
@endsection
@include('layouts.footer')

