@section('title', '新增销货订单')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/sales">销货 </a> /  新增
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


            {{--选择商品--}}
            <div class="modal" tabindex="-1"  id="select_shop" data-backdrop="static" test="" >
                <div class="modal-dialog">
                    <!-- 内容声明 -->
                    <div class="modal-content"  style="width: 750px;">
                        <!-- 头部 -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title"> <span class="glyphicon glyphicon-plus"> 选择商品</span>  </h4>
                        </div>
                        <!-- 主体 -->
                        <div class="modal-body" style="overflow: auto;max-height: 550px;" >
                            <div class="form-horizontal">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr >
                                        <th class="text-center">序号</th>
                                        <th  class="text-center">商品编号</th>
                                        <th  class="text-center">商品名称</th>
                                        <th  class="text-center">预计采购单价</th>
                                        <th  class="text-center">规格型号</th>
                                        <th  class="text-center">计量单位</th>
                                        <th  class="text-center">当前库存总数量</th>
                                        <th  class="text-center">选择</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="add-ok">

                                    </tbody>
                                </table>
                                <div>
                                    <ul class="pager" count="{{$goods->count()}}" id="pages">
                                        <li class="disabled"><a href="#"  id="prve" prev="no">上一页</a></li>
                                        <li><a href="#" style="margin-left: 20px" next="1" id="next" >下一页</a></li>
                                        <li style="margin-left: 20px;">
                                            <select name="" id="jump">
                                            </select>
                                        </li>
                                        <li><a href="#" id="jumps">跳转</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- 注脚 -->
                    </div>
                </div>
            </div>

            {{--选择仓库--}}
            <div class="modal" tabindex="-1"  id="select_warehouse" data-backdrop="static" >
                <div class="modal-dialog">
                    <!-- 内容声明 -->
                    <div class="modal-content"  style="width: 750px;">
                        <!-- 头部 -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title"> <span class="glyphicon glyphicon-plus"> 选择关联仓库</span>  </h4>
                        </div>
                        <!-- 主体 -->
                        <div class="modal-body" style="overflow: auto;max-height: 550px;" >
                            <div class="form-horizontal">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr >
                                        <th class="text-center">序号</th>
                                        <th  class="text-center">编号</th>
                                        <th  class="text-center">仓库名称</th>
                                        <th  class="text-center">选择仓库</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="add-ok-warehouse">



                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- 注脚 -->
                    </div>
                </div>
            </div>


            <div class="ibox-content">
                <div    class="form-horizontal" >

                    <div class="ibox-content" >
                        <table class="table table-bordered text-center">
                            <thead>

                            <tr>
                                <th class="text-center">调出仓库</th>
                                <th class="text-center">调出商品</th>
                                <th class="text-center">单位</th>
                                <th class="text-center">数量</th>
                                <th class="text-center">调入仓库</th>
                                <th class="text-center" style="width: 200px">操作</th>
                            </tr>
                            </thead>
                            <tbody id="add_row">
                            <tr>
                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class=" input-group">
                                                <input type="text"   class="form-control  warehouse_name" warehouse_id=""  readonly=""  style="background-color: white">
                                                <div class="input-group-addon add_warehouse" test="1" ><span class="glyphicon glyphicon-search"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>



                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class=" input-group">
                                                <input type="text"   class="form-control  goods_name" goods_id=""  readonly=""  style="background-color: white">
                                                <div class="input-group-addon add_shop" test="1" ><span class="glyphicon glyphicon-search"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 100px;">
                                    <div class="company"></div>
                                </td>

                                <td style="width: 100px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class=" input-group">
                                                <input type="text" class="form-control  number"  style="background-color: white">
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td style="width: 100px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control m-b in_warehouse" name="in_warehouse">
                                                <option></option>
                                                @foreach($warehouse as $key => $value)
                                                    <option value="{{$value->id}}" account_id="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </td>




                                <td>
                                    <a  class="btn btn-warning btn-sm  add_row"  type="button"><i class="glyphicon glyphicon-plus"></i> 新增行</a>
                                    <a class="btn btn-danger btn-sm " type="button"><i class="glyphicon glyphicon-trash"></i> 删除</a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <td style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea  class="form-control" name="details" id="details" placeholder="简介..."></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>





                            </tfoot>
                        </table>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" id="add_purchase_data">保存内容</button>
                            <a onclick="window.history.go(-1);" class="btn btn-white" type="submit">取消</a>
                        </div>
                    </div>
                </div>
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
    <script src="../js/allocation.js"></script>
@endsection
@include('layouts.footer')
<script>
    //传对象
    var yang=[];
    @foreach($warehouse as $key => $value)
        yang["{{$key}}"] = '{"id":"{{$value->id}}","name":"{{$value->name}}"}';
    @endforeach
    // var yi =JSON.parse(yang[0]);
    // alert(yi['name'])
</script>
