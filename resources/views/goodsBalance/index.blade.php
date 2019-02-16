@section('title', '商品库存余额表')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品库存余额表</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="table_basic.html#">选项1</a>
                        </li>
                        <li>
                            <a href="table_basic.html#">选项2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="ibox-content">
                    <div class="row">
                        <div>
                            <form action="/goods_balance" method="get" class="col-sm-12">


                                <div class="form-group" style="width: 395px">
                                    <label>仓库：</label>
                                    <div>
                                        <select class="form-control m-b" name="warehouse">
                                            <option></option>
                                            @foreach($warehouse as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>商品：</label>
                                    <div>
                                        <select class="form-control m-b" name="goods">
                                            <option></option>
                                            @foreach($goods as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                        <a class="btn btn-info btn-sm " type="button" href="/goods_balance/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                        <a class="btn btn-warning btn-sm " type="button" href="/goods_balance"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center" rowspan="2">商品编号</td>
                                <td class="text-center" rowspan="2">商品名称</td>
                                <td class="text-center" rowspan="2">规格型号</td>
                                <td class="text-center" rowspan="2">单位</td>
                                <td colspan="2" class="text-center" >所有仓库</td>
                                @foreach($warehouse as $key => $value)
                                <td class="text-center" >{{$value->name}}</td>
                                @endforeach
                            </tr>

                             <tr>
                                <td class="text-center" >成本</td>
                                <td  class="text-center">数量</td>
                                @foreach($warehouse as $key => $value)
                                    <td class="text-center" >数量</td>
                                @endforeach
                            </tr>

                            @foreach($model as $key => $value)
                            <tr>
                                <td class="text-center">{{$value['goodsNumber']}}</td>
                                <td class="text-center">{{$value['goodsName']}}</td>
                                <td class="text-center">{{$value['goodsSpecification']}}</td>
                                <td class="text-center">{{$value['measurement']}}</td>
                                <td class="text-center">{{$value['goodsCost']}}</td>
                                <td class="text-center">{{$value['goodsSum']}}</td>

                                @foreach($warehouse as $wKey => $wValue)
                                    <td class="text-center">
                                        @foreach($value['warehouses'] as $k => $v)
                                            @if($v['warehouse_id'] == $wValue->id)
                                                    {{$v['number']}}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach

                        </table>
                    </div>
                    <div class="text-center">
                        {{$model->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@include('layouts.footer')

