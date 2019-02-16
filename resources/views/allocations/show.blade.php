@section('title', '新增销货订单')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/allocation">仓库调度  </a> / {{$allocation->ood_number}} - 详情
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
                            </tr>
                            </thead>
                            <tbody id="add_row">
                            @foreach($allocation->getAllocationExtend as $key => $value)
                            <tr>
                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{$value->getOutWarehouse->name}}
                                        </div>
                                    </div>
                                </td>


                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{$value->getGoods->name}}
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{$value->company}}
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{$value->number}}
                                        </div>
                                    </div>
                                </td>


                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{$value->getInWarehouse->name}}
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            <tr>
                                <td style="width: 55px;"colspan="9" rowspan="1">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea  class="form-control" disabled="disabled" name="details" id="details" placeholder="简介...">{{$allocation->details}}</textarea>
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
                            <a onclick="window.history.go(-1);" class="btn btn-primary" type="submit">返回上一层</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.loading')
@include('layouts.footer')
