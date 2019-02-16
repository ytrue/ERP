@section('title', '商品管理')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品管理</h5>
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
                            @can('add goods')
                            <a class="btn btn-info btn-sm " type="button" href="/goods/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            @endcan
                            <a class="btn btn-primary btn-sm " type="button" href="/goods/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                            @can('delete goods')
                            <a class="btn btn-danger btn-sm " type="button" url="/goods/1" onclick="jumps($(this).attr('url'));"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                            @endcan
                            <a class="btn btn-warning btn-sm " type="button" href="/goods"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>

                        </div>

                        <div class="col-sm-3">
                            <form action="/goods" method="get">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control" name="search">
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
                                <th class="text-center">商品类别</th>
                                <th class="text-center">商品编号</th>
                                <th class="text-center">商品名称</th>
                                <th class="text-center">规格型号</th>
                                <th class="text-center">单位</th>
                                <th class="text-center">当前库存</th>
                                <th class="text-center">预计采购价</th>
                                <th class="text-center">零售价</th>
                                @can('status goods')
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
                                    <td class="text-center">{{$value->specification}}</td>
                                    <td class="text-center">{{$value->measurement}}</td>
                                    <td class="text-center">{{$value->current_inventory}}</td>

                                    <td class="text-center">{{$value->predicted_price}}</td>
                                    <td class="text-center">{{$value->retail_price}}</td>
                                    @can('status goods')
                                    <td class="text-center"><a url="/goods/{{$value->id}}/status" onclick="set_status($(this).attr('url'),this)">{!!$value->status !!}</a></td>
                                    @endcan
                                    <td class="text-center">
                                        <a href="/goods/{{$value->id}}" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
                                        @can('edit goods')
                                        <a href="/goods/{{$value->id}}/edit" class="btn btn-success btn-sm " type="button"><i class="fa fa-paste"></i> 编辑</a>
                                        @endcan
                                        @can('delete goods')
                                        <a class="btn btn-danger btn-sm " type="button" url="/goods/{{$value->id}}" onclick="jump($(this).attr('url'),{{$value->id}});"><i class="glyphicon glyphicon-trash"></i> 删除</a>
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

