@section('title', '购货支付')
@include('layouts.header')
<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><a href="/purchasepayment">购货支付 </a> /  {{$payment->ood_number}} - 详情
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
                            <div class="form-group">
                                <label class=" control-label col-sm-0" style="margin-left: -170px;">购货单位</label>
                                <div class="col-sm-3">
                                    <div class=" input-group">
                                        <input type="text" class="form-control " id="gys_name"  disabled="disabled" value="{{$payment->getSupplierManagement->name}}">
                                    </div>
                                </div>
                            </div>
                            <tr>
                                <th class="text-center">购货订单</th>
                                <th class="text-center">未支付金额</th>
                                <th class="text-center">付款金额</th>
                                <th class="text-center">结算账户</th>
                                <th class="text-center">结算方式</th>

                            </tr>
                            </thead>
                            <tbody id="add_row">
                            @foreach($payment->getPaymentExtend as $key => $value)
                            <tr>
                                <td style="width: 200px;">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class=" input-group">
                                                    {{$value->getOrder->document_number}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td  >
                                    <div class="unpaid_amount">
                                        {{$value->unpaid_amount}}
                                    </div>
                                </td>

                                <td  >
                                    <div class="unpaid_amount">
                                        {{$value->payment_amount}}
                                    </div>
                                </td>

                                <td >
                                    <div class="unpaid_amount">
                                        {{$value->getAccount->name}}
                                    </div>
                                </td>

                                <td >
                                    <div class="unpaid_amount">
                                        {{$value->getSettlement->name}}
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
                                            <textarea  disabled class="form-control" name="details" id="details" placeholder="简介...">{{$payment->details}}</textarea>
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

