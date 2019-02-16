@section('title', '客户管理')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>客户管理</h5>
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
                            @can('add client')
                            <a class="btn btn-info btn-sm " type="button" href="/client/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            @endcan
                            <a class="btn btn-primary btn-sm " type="button" href="/client/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                            @can('delete client')
                            <a class="btn btn-danger btn-sm " type="button" url="/client/1" onclick="jumps($(this).attr('url'));"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                            @endcan
                            <a class="btn btn-warning btn-sm " type="button" href="/client"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>

                        </div>

                        <div class="col-sm-3">
                            <form action="/client" method="get">
                                <div class="input-group">
                                    <input type="text" placeholder="请按照客户编号，客户名称,客户类别查询" class="input-sm form-control" name="search">
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
                                <th class="text-center">客户类别</th>
                                <th class="text-center">客户编号</th>
                                <th class="text-center">客户名称</th>
                                <th class="text-center">客户等级</th>
                                <th class="text-center">联系人</th>
                                <th class="text-center">手机号码</th>
                                <th class="text-center">座机号码</th>
                                <th class="text-center">QQ/MSN</th>
                                <th class="text-center">初期往来余额</th>
                                <th class="text-center">货物配送地址</th>
                                @can('status client')
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
                                    <td class="text-center">{{$value->level}}</td>
                                    <td class="text-center">{{$value->getClientExtend->contacts}}</td>
                                    <td class="text-center">{{$value->getClientExtend->phone}}</td>
                                    <td class="text-center">{{$value->getClientExtend->landline}}</td>
                                    <td class="text-center">{{$value->getClientExtend->qq}}</td>
                                    <td class="text-center">{{$value->initial_payable - $value->initial_advance_payment}}</td>
                                    <td class="text-center"> {!! str_limit($value->getClientExtend->address,8,'...') !!}</td>
                                    @can('status client')
                                    <td class="text-center"><a url="/client/{{$value->id}}/status" onclick="set_status($(this).attr('url'),this)">{!!$value->status !!}</a></td>
                                    @endcan
                                    <td class="text-center">
                                        <a href="/client/{{$value->id}}" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
                                        @can('edit client')
                                        <a href="/client/{{$value->id}}/edit" class="btn btn-success btn-sm " type="button"><i class="fa fa-paste"></i> 编辑</a>
                                        @endcan
                                        @can('delete client')
                                        <a class="btn btn-danger btn-sm " type="button" url="/client/{{$value->id}}" onclick="jump($(this).attr('url'),{{$value->id}});"><i class="glyphicon glyphicon-trash"></i> 删除</a>
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

