@include('layouts.header')
<body class="gray-bg">
<div class="wrapper wrapper-content">
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">月</span>
                <h5>收入</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">40 886,200</h1>
                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i>
                </div>
                <small>总收入</small>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-success pull-right">月</span>
            <h5>支出</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">40 886,200</h1>
            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i>
            </div>
            <small>总收入</small>
        </div>
    </div>
</div>

    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>订单</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">275,800</h1>
                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i>
                </div>
                <small>新订单</small>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-danger pull-right">资金</span>
                <h5>资金</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">80,600</h1>
                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                </div>
                <small>12月</small>
            </div>
        </div>
    </div>
</div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Yang-erp未完成部分</h5>

        </div>
        <div class="ibox-content ibox-heading">
            <h3>还有约几个细节未处理</h3>
            <small><i class="fa fa-map-marker"></i> 地点当然是在家里啦！</small>
        </div>
        <div class="ibox-content timeline">


            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-7 content ui-sortable">
                        <p class="m-b-xs"><strong>Yang-erp首页未完成</strong></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-7 content ui-sortable">
                        <p class="m-b-xs"><strong>权限设置中的用户的修改，删除未完成</strong></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-7 content ui-sortable">
                        <p class="m-b-xs"><strong>辅助资料and基础资料的数据被关联时不能删除未完成</strong></p>
                    </div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-7 content ui-sortable">
                        <p class="m-b-xs"><strong>日志只完成了登录模块的记录</strong></p>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-7 content ui-sortable">
                        <p class="m-b-xs"><strong>仓库报表中的商品收发明细表只完成了前端页面</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
