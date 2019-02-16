@section('title', '销售汇总表(按商品)')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>销售汇总表(按商品)</h5>
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
                            <form action="/sales_summary_goods" method="get" class="col-sm-12">
                                <div class="form-group" id="data_5">
                                    <label>日期：</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="background: white" readonly name="start_date">
                                        <span class="input-group-addon">到</span>
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" readonly  style="background: white" name="end_date">
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>客户：</label>
                                    <div>
                                        <select class="form-control m-b" name="client">
                                            <option></option>
                                            @foreach($client as $value)
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
                                    <label>销售人员：</label>
                                    <div>
                                        <select class="form-control m-b" name="staff">
                                            <option></option>
                                            @foreach($staff as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                        <a class="btn btn-info btn-sm " type="button" href="/sales_summary_goods/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                        <a class="btn btn-warning btn-sm " type="button" href="/sales_summary_goods"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">商品编号</th>
                                <th class="text-center">商品名称</th>
                                <th class="text-center">规格型号</th>
                                <th class="text-center">单位</th>
                                <th class="text-center">仓库</th>
                                <th class="text-center">数量</th>
                                <th class="text-center">单价</th>
                                <th class="text-center">销售收入</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $value)
                                <tr>
                                    <td class="text-center">{{$value['goods_number']}}</td>
                                    <td class="text-center">{{$value['goods_name']}}</td>
                                    <td class="text-center">{{$value['specification']}}</td>
                                    <td class="text-center">{{$value['measurement']}}</td>
                                    <td class="text-center">{{$value['warehouse_name']}}</td>
                                    <td class="text-center">{{$value['number']}}</td>
                                    <td class="text-center">{{$value['unit_purchase_price']}}</td>
                                    <td class="text-center">{{$value['purchase_amount']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
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

