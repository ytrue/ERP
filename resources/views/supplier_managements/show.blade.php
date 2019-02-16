@section('title', '供应商管理详情')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/suppliermanagement">供应商管理 </a> / {{$suppliermanagement->name}} - 详情
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
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">供应商编号</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$suppliermanagement->number}}" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">供应商名称</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$suppliermanagement->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">供应类别</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"value="{{$suppliermanagement->type}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">余额日期</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->balance_date}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">期初应付款</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->initial_payable}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">期初预付款</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->initial_advance_payment}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">增值税税率</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"disabled="disabled" value="{{$suppliermanagement->rate}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">联系人</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->getSupplierManagementExtend['contacts']}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">初期往余额	</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"  disabled value="{{$suppliermanagement->initial_payable- $suppliermanagement->initial_advance_payment}}">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">手机号码</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->getSupplierManagementExtend['phone']}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">座机号码</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->getSupplierManagementExtend['landline']}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">QQ/MSN</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->getSupplierManagementExtend['qq']}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">联系地址</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="disabled" value="{{$suppliermanagement->getSupplierManagementExtend['address']}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">创建时间</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"disabled="disabled" value="{{$suppliermanagement->created_at}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-4 control-label">最近修改时间</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"disabled="disabled" value="{{$suppliermanagement->updated_at}}">
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-6">
                            <a onclick="window.history.go(-1);"class="btn btn-primary" type="submit">返回上一层</a>
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

