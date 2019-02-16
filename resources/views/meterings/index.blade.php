@section('title', '计量单位')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>计量单位</h5>
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
                            @can('add metering')
                            <a class="btn btn-info btn-sm " type="button" href="/metering/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            @endcan
                            @can('delete metering')
                            <a class="btn btn-danger btn-sm " type="button" url="/metering/1" onclick="jumps($(this).attr('url'));"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                            @endcan
                            <a class="btn btn-warning btn-sm " type="button" href="/metering"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                        </div>

                        <div class="col-sm-3">
                            <form action="/metering" method="get">
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
                                <th class="text-center">名称</th>
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
                                    <td class="text-center">{{$value->name}}</td>
                                    <td class="text-center">
                                        <a href="/metering/{{$value->id}}" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
                                        @can('edit metering')
                                        <a href="/metering/{{$value->id}}/edit" class="btn btn-success btn-sm " type="button"><i class="fa fa-paste"></i> 编辑</a>
                                        @endcan
                                        @can('delete metering')
                                        <a class="btn btn-danger btn-sm " type="button" url="/metering/{{$value->id}}" onclick="jump($(this).attr('url'),{{$value->id}});"><i class="glyphicon glyphicon-trash"></i> 删除</a>
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
@include('layouts.footer')

