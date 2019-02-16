@section('title', '修改商品管理')
@include('layouts.header-edit')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/goods">商品管理 </a> / {{$goods->name}} -  修改
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
                <form class="form-horizontal" id="reg" method="post" action="/goods">
                    <input type="hidden" value="{{$goods->id}}"  id="goods_id">
                    <div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品编号</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="number" id="number" value="{{$goods->number}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{$goods->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品条码</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bar_code" id="bar_code" value="{{$goods->bar_code}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">规格型号</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="specification" id="specification" value="{{$goods->specification}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品类别</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b test selects" name="type"  id="type">
                                @foreach($commodity as $key => $value)
                                    @if($goods->type == $value->name)
                                        <option value="{{$value->name}}" selected="selected">{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->name}}">{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">最低库存</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="minimum" id="minimum" value="{{$goods->minimum}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">最高库存</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="maximum" id="maximum" value="{{$goods->maxnum}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">计量单位</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b test selects"  name="measurement" id="measurement">
                                <option></option>
                                @foreach($metering as $key => $value)
                                    @if($goods->measurement == $value->name)
                                        <option value="{{$value->name}}" selected="selected">{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->name}}">{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">预计采购价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="predicted_price" id="predicted_price" value="{{$goods->predicted_price}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">零售价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="retail_price" id="retail_price" value="{{$goods->retail_price}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">批发价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="wholesale_price" id="wholesale_price" value="{{$goods->wholesale_price}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">VIP会员价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="vip_price" id="vip_price" value="{{$goods->vip_price}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">折扣率一(%)</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="discount_one" id="discount_one" value="{{$goods->discount_one}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">折扣率二(%)</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="discount_two" id="discount_two" value="{{$goods->discount_two}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">保存内容</button>
                            <a onclick="window.history.go(-1);" class="btn btn-white" type="submit">取消</a>
                        </div>
                    </div>
                </form>
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
    <script src="../../js/goods-edit.js"></script>
@endsection
@include('layouts.footer-edit')


