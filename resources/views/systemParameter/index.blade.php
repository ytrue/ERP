@section('title', '系统基础参数')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/supplier">系统基础参数 </a>
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
                <form method="post" class="form-horizontal"  action="/system_parameter" id="reg">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="Yang-ERP">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司地址</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" value="广西壮族自治区桂林市">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司电话</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" value="17687410790">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司传真</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fax" value="434654645322">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司邮编</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="zipCode" value="529836">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">本位币</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="standardCurrency" value="RMB">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">存货计价方法</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inventoryValuationMethod" value="移动平均法">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">保存内容</button>
                        </div>
                    </div>
                </>
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

@include('layouts.footer')

