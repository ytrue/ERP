@section('title', '操作日志')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>操作日志</h5>
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
                            <a class="btn btn-warning btn-sm " type="button" href="/log"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">日期</th>
                                <th class="text-center">用户名</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">日志</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $value)
                                <tr>
                                    <td class="text-center">{{$value->created_at}}</td>
                                    <td class="text-center">{{$value->getUser->name}}</td>
                                    <td class="text-center">{{$value->getUser->real_name}}</td>
                                    <td class="text-center">{{$value->message}}</td>
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

