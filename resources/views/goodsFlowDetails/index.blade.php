@section('title', '商品收发明细表')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品收发明细表</h5>
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
                                <div class="form-group" id="data_5">
                                    <label>日期：</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="background: white" readonly name="start_date">
                                        <span class="input-group-addon">到</span>
                                        <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" readonly  style="background: white" name="end_date">
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>业务类型：</label>
                                    <div>
                                        <select class="form-control m-b" name="type">
                                            <option></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="width: 395px">
                                    <label>仓库：</label>
                                    <div>
                                        <select class="form-control m-b" name="warehouse">
                                            <option></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group" style="width: 395px">
                                    <label>商品：</label>
                                    <div>
                                        <select class="form-control m-b" name="goods">
                                            <option></option>

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
                                <td class="text-center">商品编号</td>
                                <td class="text-center">商品名称</td>
                                <td class="text-center">规格型号</td>
                                <td class="text-center">单位</td>
                                <td class="text-center">日期</td>
                                <td class="text-center">单据号</td>
                                <td class="text-center">业务类型</td>
                                <td class="text-center">仓库</td>
                                <td class="text-center">数量</td>
                            </tr>


                            
                        </table>
                    </div>
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@include('layouts.footer')

