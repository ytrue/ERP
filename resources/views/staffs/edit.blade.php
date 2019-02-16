@section('title', '修改职员管理')
@include('layouts.header-edit')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/staff">职员管理 </a> / {{$staff->name}} - 修改
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
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
                <form method="post" class="form-horizontal"  action="/staff/{{$staff->id}}" id="reg">
                    {{method_field("PUT")}}
                    {{csrf_field()}}
                    <input type="hidden" value="{{$staff->id}}" id="staff_id" name="id">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">职员编号</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number" value="{{$staff->number}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">职员名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{$staff->name}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">保存内容</button>
                            <a onclick="window.history.go(-1);" class="btn btn-white" type="submit">取消</a>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@section('extend-js')
    <script src="../../js/staff.js"></script>
@endsection
@include('layouts.footer-edit')

