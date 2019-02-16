@section('title', '修改-客户管理')
@include('layouts.header-edit')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/client">客户管理 </a> / {{$client->name}} -  修改
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
                <form method="post" class="form-horizontal"  action="/client" id="reg">
                    <input type="hidden" value="{{$client->id}}" id="client_id">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户编号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="number" value="{{$client->number}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{$client->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户类别</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="type" id="type">
                                <option></option>
                                @foreach($customer as $key => $value)
                                    @if($client->type == $value->name)
                                        <option value="{{$value->name}}" selected>{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->name}}">{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-2 control-label">客户等级</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="level" id="level">
                                <option></option>
                                @if($client->level == '零售客户')
                                    <option value="零售客户" selected>零售客户</option>
                                @else
                                    <option value="零售客户">零售客户</option>
                                @endif
                                @if($client->level == '批发客户')
                                    <option value="批发客户" selected>批发客户</option>
                                @else
                                    <option value="批发客户">批发客户</option>
                                @endif
                                @if($client->level == 'VIP客户')
                                    <option value="VIP客户" selected>VIP客户</option>
                                @else
                                    <option value="VIP客户">VIP客户</option>
                                @endif
                                @if($client->level == '折扣等级一')
                                    <option value="折扣等级一" selected>折扣等级一</option>
                                @else
                                    <option value="折扣等级一">折扣等级一</option>
                                @endif
                                @if($client->level == '折扣等级二')
                                    <option value="折扣等级二" selected>折扣等级二</option>
                                @else
                                    <option value="折扣等级二">折扣等级二</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">余额日期</label>
                        <div class="col-sm-10">
                            <input name="balance_date" id="balance_date" class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" value="{{$client->balance_date}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初应付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_payable" id="initial_payable" value="{{$client->initial_payable}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">期初预付款</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="initial_advance_payment" id="initial_advance_payment" value="{{$client->initial_advance_payment}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">联系人</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts" id="contacts" value="{{$client->getClientExtend['contacts']}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">手机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{$client->getClientExtend['phone']}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">座机号码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="landline" id="landline" value="{{$client->getClientExtend['landline']}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ/MSN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="qq" id="qq" value="{{$client->getClientExtend['qq']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">配送地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" value="{{$client->getClientExtend['address']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述简介</label>
                        <div class="col-sm-10">
                            <textarea  class="form-control" name="info" id="info" placeholder="描述简介..." >{{$client->getClientExtend['info']}}</textarea>
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
<!--成功-->
<div class="modal" tabindex="-1"  id="ok" data-backdrop="static" >
    <div class="modal-dialog" style="width: 180px;">
        <!-- 内容声明 -->
        <div class="modal-content">
            <!-- 头部 -->
            <!-- 主体 -->
            <div class="modal-body">
                <img src="../../images/loading.gif" alt="" style="margin-left: -20px;" id="ok-img" > <span id="ok-text">&nbsp;&nbsp;数据交互中...</span>
            </div>
            <!-- 注脚 -->

        </div>
    </div>
</div>
@section('extend-js')
    <script src="../../js/client-edit.js"></script>
@endsection
@include('layouts.footer-edit')

