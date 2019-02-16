@section('title', '客户对账单')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>客户对账单</h5>
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
                            <form action="/customers_reconciliation_new" method="get" class="col-sm-12">
                                <div class="form-group" id="data_5">
                                    <label>日期：</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="background: white" readonly name="start_date">
                                        <span class="input-group-addon">到</span>
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" readonly  style="background: white" name="end_date">
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>客户
                                        ：</label>
                                    <div>
                                        <select class="form-control m-b" name="client">
                                            <option></option>
                                            @foreach($client as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">查询内容</button>
                                        <a class="btn btn-info btn-sm " type="button" href="/customers_reconciliation_new/excel"><i class="glyphicon glyphicon-share"></i> 导出Excel</a>
                                        <a class="btn btn-warning btn-sm " type="button" href="/customers_reconciliation_new"><i class="glyphicon glyphicon-refresh"></i>  重置 / 刷新</a>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">客户</th>
                                <th class="text-center">单据日期</th>
                                <th class="text-center">单据编号</th>
                                <th class="text-center">业务类型</th>
                                <th class="text-center">销售金额</th>
                                <th class="text-center">整单折扣额</th>
                                <th class="text-center">应收金额</th>
                                <th class="text-center">实际收款金额</th>
                                <th class="text-center">应收款余额</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key => $value)
                                <tr>
                                    <td class="text-center">{{$value['name']}}</td>
                                    <td class="text-center">{{$value['createTime']}}</td>
                                    <td class="text-center">{{$value['documentNumber']}}</td>
                                    <td class="text-center">{{$value['type']}}</td>
                                    <td class="text-center">{{$value['salesAmount']}}</td>
                                    <td class="text-center">{{$value['wholeSingleDiscount']}}</td>
                                    <td class="text-center">{{$value['totalAmount']}}</td>
                                    <td class="text-center">{{$value['paid']}}</td>
                                    <td class="text-center">{{$value['unpaidAmount']}}</td>
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

