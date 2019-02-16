@section('title', '供应商类别-详情')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/supplier">供应商类别列表 </a> / {{$supplier->name}} - 详情
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
                <div  method="post" class="form-horizontal"  action="/supplier" id="reg">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商类别</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled="disabled" value="{{$supplier->name}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">创建时间</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control"  disabled="disabled" value="{{$supplier->created_at}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">最近修改时间</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled="disabled" value="{{$supplier->updated_at}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" onclick="window.history.go(-1);">返回上一层</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

