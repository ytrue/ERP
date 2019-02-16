@section('title', '仓库调度')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>仓库调度</h5>
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
                            @can('add allocation')
                            <a class="btn btn-info btn-sm " type="button" href="/allocation/create"><i class="glyphicon glyphicon-plus"></i> 新增</a>
                            @endcan
                            <a class="btn btn-warning btn-sm " type="button" href="/allocation"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                        </div>

                        <div class="col-sm-3">
                            <form action="/allocation" method="get">
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
                                <th class="text-center">单据日期</th>、
                                <th class="text-center">商品</th>
                                <th class="text-center">总数量</th>
                                <th class="text-center">调出仓库</th>
                                <th class="text-center">调入仓库</th>
                                <th class="text-center">制单人</th>
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
                                    <td class="text-center">{{$value->created_at}}</td>

                                    <td class="text-center">
                                        @foreach($value->getAllocationExtend as $k => $v)
                                            {{$v->getGoods->name}}，
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        @php
                                             $number = null;
                                             foreach($value->getAllocationExtend as $k => $v){
                                                $number += $v->number;
                                             }
                                             echo $number;
                                        @endphp
                                    </td>

                                    <td class="text-center">
                                        @foreach($value->getAllocationExtend as $k => $v)
                                            {{$v->getOutWarehouse->name}}，
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach($value->getAllocationExtend as $k => $v)
                                            {{$v->getInWarehouse->name}}，
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{$value->getUser->name}}</td>
                                    <td class="text-center">
                                        <a href="/allocation/{{$value->id}}" class="btn btn-primary btn-sm " type="button"><i class="fa fa-money"></i> 查看</a>
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

