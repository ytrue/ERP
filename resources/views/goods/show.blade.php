@section('title', '查看商品详情')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/settlement">商品管理 </a> /  {{$goods->name}} - 详情
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
                <div class="form-horizontal">
                    <div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="col-sm-3 control-label">商品编号</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="number" id="number" disabled="disabled" value="{{$goods->number}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label class="col-sm-3 control-label">商品名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" disabled value="{{$goods->name}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-3 control-label">商品条码</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="bar_code" id="bar_code" disabled="disabled" value="{{$goods->bar_code}}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label class="col-sm-3 control-label">规格型号</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="specification" id="specification" disabled value="{{$goods->specification}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">商品类别</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="specification" id="specification" disabled value="{{$goods->type}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">最低库存</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="minimum" id="minimum" disabled value="{{$goods->minimum}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">最高库存</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="maximum" id="maximum" disabled="disabled" value="{{$goods->maxnum}}">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">计量单位</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="specification" id="specification" disabled value="{{$goods->measurement}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">预计采购价</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="predicted_price" id="predicted_price" disabled value="{{$goods->predicted_price}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">零售价</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="retail_price" id="retail_price" disabled value="{{$goods->retail_price}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">批发价</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="wholesale_price" id="wholesale_price" disabled value="{{$goods->wholesale_price}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">VIP会员价</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vip_price" id="vip_price" disabled value="{{$goods->vip_price}}">
                        </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">折扣率一(%)</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="discount_one" id="discount_one" disabled value="{{$goods->discount_one}}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">折扣率二(%)</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="discount_two" id="discount_two" disabled value="{{$goods->discount_two}}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">当前库存</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="discount_two" id="discount_two" disabled value="{{$goods->current_inventory}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">创建时间</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vip_price" id="vip_price" disabled value="{{$goods->created_at}}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-3 control-label">修改时间</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="discount_one" id="discount_one" disabled value="{{$goods->updated_at}}">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" onclick="window.history.go(-1);">返回上一层</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

