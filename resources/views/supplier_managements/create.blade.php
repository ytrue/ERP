@section('title', '新增供应商管理')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/suppliermanagement">供应商管理 </a> /  新增
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>Q
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
                <form method="post" class="form-horizontal"  action="/suppliermanagement" id="reg">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商编号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应商名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">供应类别</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="type" id="type">
                                <option></option>
                                @foreach($supplier as $key => $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">余额日期</label>
                        <div class="col-sm-10">
                            <input name="balance_date" id="balance_date" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初应付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_payable" id="initial_payable">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初预付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_advance_payment" id="initial_advance_payment">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">增值税税率</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="rate" id="rate">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts" id="contacts">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">座机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="landline" id="landline">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ/MSN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="qq" id="qq">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>

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
@include('layouts.loading')
@section('extend-js')
    <script src="../js/supplier_management.js"></script>
@endsection
@include('layouts.footer')

