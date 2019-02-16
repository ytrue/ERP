@section('title', '修改账户管理')
@include('layouts.header-edit')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/account">账户管理 </a> / {{$account->name}} -  修改
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
                <form method="post" class="form-horizontal"  action="/account/{{$account->id}}" id="reg">
                    {{csrf_field()}}
                    {{method_field("PUT")}}
                    <input type="hidden" value="{{$account->id}}" id="account_id" name="id">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账户编号</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number" value="{{$account->number}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账户名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{$account->name}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">余额日期</label>

                        <div class="col-sm-10">
                            <input name="balance_date" id="balance_date"  value="{{$account->balance_date}}"  class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账户余额</label>
                        <div class="col-sm-10">
                            <div class="input-group m-b"><span class="input-group-addon">¥</span>
                                <input type="text" class="form-control" name="balance" value="{{$account->balance}}">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">账户类别</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="type" id="type">
                                @if($account->type == '现金')
                                    <option value="1"  selected>现金</option>
                                    <option value="2">银行存款</option>
                                    @else
                                    <option value="1">现金</option>
                                    <option value="2" selected>银行存款</option>
                                @endif

                            </select>
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
    <script src="../../js/settlement_account.js"></script>
@endsection
@include('layouts.footer-edit')

