$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //美观验证
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            element.closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                error.appendTo(element.parent().parent().parent());
            } else {
                error.appendTo(element.parent());
            }
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });


    //select
    var counts_client = Math.ceil($("#pages-client").attr('count') / 10);
    for (var i = 1; i <= counts_client; i++) {
        $('#jump-client').append(' <option value="' + i + '">' + i + '</option>')
    }

    //选择关联供应商
    $("#add_gys").click(function () {
        $.ajax({
            url: '/purchasepayment/get_supplier',
            type: 'POST',
            beforeSend: function () {
                $('#ok').modal('show');
                $("#myModal").modal('hide');
            },
            success: function (r, x, s) {
                $('#ok-img').attr('src', '../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');
                $("#add-ok-client").children().remove();
                for (var i = 0; i < r.length; i++) {
                    $('#add-ok-client').append('  <tr>\n' +
                        '                                      <td  client_id="' + r[i]['id'] + '" >' + parseInt(i + 1) + '</td>\n' +
                        '                                        <td>' + r[i]['number'] + '</td>\n' +
                        '                                        <td>' + r[i]['type'] + '</td>\n' +
                        '                                        <td>' + r[i]['name'] + '</td>\n' +
                        '                                        <td>' + r[i]['contacts'] + '</td>\n' +
                        '                                        <td>' + r[i]['phone'] + '</td>\n' +
                        '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_client").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                }, 100)
            }

        })
    });


    //下一页
    $("#next-client").click(function () {
        var count = Math.ceil($("#pages-client").attr('count') / 10);
        var i = parseInt($(this).attr('next'));
        var j = i + 1;
        $("#prve-client").parent().removeClass('disabled');
        if (i < count) {
            $(this).attr('next', j);
            $("#prve-client").attr('prev', j);
            $.ajax({
                url: '/purchasepayment/get_supplier',
                type: 'POST',
                data: {
                    id: j
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                    $("#select_client").modal('hide');
                },
                success: function (r, x, s) {
                    $('#ok-img').attr('src', '../images/jump_success.png');
                    $('#ok-text').html('数据交互成功!');
                    $("#add-ok-client").children().remove();
                    for (var i = 0; i < r.length; i++) {
                        $('#add-ok-client').append('  <tr>\n' +
                            '                                      <td  client_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                            '                                        <td>' + r[i]['number'] + '</td>\n' +
                            '                                        <td>' + r[i]['type'] + '</td>\n' +
                            '                                        <td>' + r[i]['name'] + '</td>\n' +
                            '                                        <td>' + r[i]['contacts'] + '</td>\n' +
                            '                                        <td>' + r[i]['phone'] + '</td>\n' +
                            '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');

                    }
                    setTimeout(function () {
                        $("#select_client").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src', '../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    }, 100)
                }

            })
        } else {
            $(this).parent().addClass("disabled")
        }
    });

    //上一页
    $("#prve-client").click(function () {
        if ($(this).attr('prev') != 'no') {
            var i = parseInt($(this).attr('prev'));
            var next = parseInt($("#next-client").attr('next'));
            var newNext = next - 1;
            var j = i - 1;
            $(this).attr('prev', j);
            $("#next-client").attr('next', newNext);
            if (i <= 1) {
                $("#next-client").attr('next', newNext + 1);
                $(this).parent().addClass('disabled')
                $(this).attr('prev', 'no');
            } else {
                $.ajax({
                    url: '/purchasepayment/get_supplier',
                    type: 'POST',
                    data: {
                        id: j
                    },
                    beforeSend: function () {
                        $('#ok').modal('show');
                        $("#select_client").modal('hide');
                    },
                    success: function (r, x, s) {
                        $('#ok-img').attr('src', '../images/jump_success.png');
                        $('#ok-text').html('数据交互成功!');
                        $("#add-ok-client").children().remove()
                        for (var i = 0; i < r.length; i++) {
                            $('#add-ok-client').append('  <tr>\n' +
                                '                                      <td  client_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                                '                                        <td>' + r[i]['number'] + '</td>\n' +
                                '                                        <td>' + r[i]['type'] + '</td>\n' +
                                '                                        <td>' + r[i]['name'] + '</td>\n' +
                                '                                        <td>' + r[i]['contacts'] + '</td>\n' +
                                '                                        <td>' + r[i]['phone'] + '</td>\n' +
                                '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                        }
                        setTimeout(function () {
                            $("#select_client").modal('show');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src', '../images/loading.gif');
                            $('#ok-text').html('数据交互中..,');
                        }, 100)
                    }

                })
            }
        }
    });


    //跳转
    $("#jumps-client").click(function () {
        $.ajax({
            url: '/purchasepayment/get_supplier',
            type: 'POST',
            data: {
                id: $("#jump-client option:selected").val(),
            },
            beforeSend: function () {
                $('#ok').modal('show');
                $("#select_client").modal('hide');
            },
            success: function (r, x, s) {
                $('#ok-img').attr('src', '../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');

                $('#next-client').attr('next', $("#jump-client option:selected").val());
                $('#prve-client').attr('prev', $("#jump-client option:selected").val());
                $("#next-client").parent().attr('class', '');
                $("#prve-client").parent().attr('class', '');
                $("#add-ok-client").children().remove()
                for (var i = 0; i < r.length; i++) {
                    $('#add-ok-client').append('  <tr>\n' +
                        '                                      <td  client_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + ($("#jump-client option:selected").val() - 1) * 10) + '</td>\n' +
                        '                                        <td>' + r[i]['number'] + '</td>\n' +
                        '                                        <td>' + r[i]['type'] + '</td>\n' +
                        '                                        <td>' + r[i]['name'] + '</td>\n' +
                        '                                        <td>' + r[i]['contacts'] + '</td>\n' +
                        '                                        <td>' + r[i]['phone'] + '</td>\n' +
                        '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_client").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                }, 100)
            }
        })
    });

    //选择
    $("#add-ok-client").on('click', '.documentary', function () {
        $("#gys_name").val($(this).parents(":eq(0)").children(":eq(3)").html());
        $("#gys_name").attr('client_id', $(this).parents(":eq(0)").children(":eq(0)").attr('client_id'))
        $("#select_client").modal('hide');
        $("#myModal").modal('show');
    });


    function in_array(array, val) {

        s = String.fromCharCode(2);

        var r = new RegExp(s + val + s);

        return (r.test(s + array.join(s) + s));

    }


    //添加商品
    $("#add_row").on('click', '.add_shop', function () {
        var newArray = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            newArray[i] = $(".goods_name").eq(i).attr('goods_id')
        }
        var gys_name = $("#gys_name").attr('client_id');
        if (gys_name) {
            $("#select_shop").attr('test', $(this).attr('test'));
            $.ajax({
                url: '/purchasepayment/get_purchase',
                type: 'POST',
                data: {
                    supplier_id: gys_name
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                    $("#myModal").modal('hide');
                },
                success: function (r, x, s) {
                    $('#ok-img').attr('src', '../images/jump_success.png');
                    $('#ok-text').html('数据交互成功！');
                    $("#add-ok").children().remove();
                    for (var i = 0; i < r.length; i++) {
                        if (!in_array(newArray, r[i]['id'])) {
                            $('#add-ok').append(' <tr>\n' +
                                '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt(i + 1) + '</td>\n' +
                                '                                        <td>' + r[i]['document_number'] + '</td>\n' +
                                '                                        <td>' + r[i]['total_amount'] + '</td>\n' +
                                '                                        <td>' + r[i]['paid'] + '</td>\n' +
                                '                                        <td><a class="details" details_id="' + r[i]['id'] + '"><i class="fa fa-file-text-o"></i></a></td>\n' +
                                '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                   </tr>');
                        }
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src', '../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                        $('#pages').attr('count', r.length)
                        //select
                        var counts = Math.ceil($("#pages").attr('count') / 10);
                        for (var i = 1; i <= counts; i++) {
                            $('#jump').append(' <option value="' + i + '">' + i + '</option>')
                        }
                    }, 100)
                }

            })
        } else {
            swal({title: "error", text: "请先选择购货单位", type: "error"})
        }
    });


    //查看详情
    $("#add-ok").on('click', '.details', function () {
        var purchaseId = $(this).attr('details_id');

        $.ajax({
            url: '/purchasepayment/get_details',
            type: 'POST',
            data: {
                purchaseId: purchaseId,
            },
            beforeSend: function () {
                $('#ok').modal('show');
            },
            success: function (r, x, s) {
                $('#ok-img').attr('src', '../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');
                $("#list-add_ok").children().remove();
                for (var i = 0; i < r.length; i++) {

                    $('#list-add_ok').append('<tr>\n' +
                        '                                            <td class="text-center">' + r[i]['number'] + '</td>\n' +
                        '                                            <td class="text-center">' + r[i]['name'] + '</td>\n' +
                        '                                            <td class="text-center">' + r[i]['measurement'] + '</td>\n' +
                        '                                            <td class="text-center">' + r[i]['goods_number'] + '</td>\n' +
                        '                                            <td class="text-center">' + r[i]['purchase_amount'] + '</td>\n' +
                        '                                        </tr>');


                }
                setTimeout(function () {
                    $("#purchase_details").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                }, 100)
            }

        });
    })


    //下一页
    $("#next").click(function () {
        var newArray = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            newArray[i] = $(".goods_name").eq(i).attr('goods_id')
        }
        var gys_name = $("#gys_name").attr('client_id');
        var count = Math.ceil($("#pages").attr('count') / 10);
        var i = parseInt($(this).attr('next'));
        var j = i + 1;
        $("#prve").parent().removeClass('disabled');
        if (i < count) {
            $(this).attr('next', j);
            $("#prve").attr('prev', j);
            $.ajax({
                url: '/purchasepayment/get_purchase',
                type: 'POST',
                data: {
                    id: j,
                    supplier_id: gys_name
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                    $("#select_shop").modal('hide');
                },
                success: function (r, x, s) {
                    $('#ok-img').attr('src', '../images/jump_success.png');
                    $('#ok-text').html('数据交互成功!');
                    $("#add-ok").children().remove();
                    for (var i = 0; i < r.length; i++) {
                        if (!in_array(newArray, r[i]['id'])) {
                            $('#add-ok').append('  <tr>\n' +
                                '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                                '                                        <td>' + r[i]['document_number'] + '</td>\n' +
                                '                                        <td>' + r[i]['total_amount'] + '</td>\n' +
                                '                                        <td>' + r[i]['paid'] + '</td>\n' +
                                '                                        <td><a class="details" details_id="' + r[i]['id'] + '"><i class="fa fa-file-text-o"></i></a></td>\n' +
                                '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                        }
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src', '../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                        $('#pages').attr('count', r.length)
                        //select
                        var counts = Math.ceil($("#pages").attr('count') / 10);
                        for (var i = 1; i <= counts; i++) {
                            $('#jump').append(' <option value="' + i + '">' + i + '</option>')
                        }
                    }, 100)
                }

            })
        } else {
            $(this).parent().addClass("disabled")
        }
    });

    //上一页
    $("#prve").click(function () {
        var newArray = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            newArray[i] = $(".goods_name").eq(i).attr('goods_id')
        }
        var gys_name = $("#gys_name").attr('client_id');
        if ($(this).attr('prev') != 'no') {
            var i = parseInt($(this).attr('prev'));
            var next = parseInt($("#next").attr('next'));
            var newNext = next - 1;
            var j = i - 1;
            $(this).attr('prev', j);
            $("#next").attr('next', newNext);
            if (i <= 1) {
                $("#next").attr('next', newNext + 1);
                $(this).parent().addClass('disabled')
                $(this).attr('prev', 'no');
            } else {
                $.ajax({
                    url: '/purchasepayment/get_purchase',
                    type: 'POST',
                    data: {
                        id: j,
                        supplier_id: gys_name
                    },
                    beforeSend: function () {
                        $('#ok').modal('show');
                        $("#select_shop").modal('hide');
                    },
                    success: function (r, x, s) {
                        $('#ok-img').attr('src', '../images/jump_success.png');
                        $('#ok-text').html('数据交互成功!');
                        $("#add-ok").children().remove()
                        for (var i = 0; i < r.length; i++) {
                            if (!in_array(newArray, r[i]['id'])) {
                                $('#add-ok').append('  <tr>\n' +
                                    '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                                    '                                        <td>' + r[i]['document_number'] + '</td>\n' +
                                    '                                        <td>' + r[i]['total_amount'] + '</td>\n' +
                                    '                                        <td>' + r[i]['paid'] + '</td>\n' +
                                    '                                        <td><a class="details" details_id="' + r[i]['id'] + '"><i class="fa fa-file-text-o"></i></a></td>\n' +
                                    '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                    '                                    </tr>');
                            }
                        }
                        setTimeout(function () {
                            $("#select_shop").modal('show');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src', '../images/loading.gif');
                            $('#ok-text').html('数据交互中..,');
                            $('#pages').attr('count', r.length)
                            //select
                            var counts = Math.ceil($("#pages").attr('count') / 10);
                            for (var i = 1; i <= counts; i++) {
                                $('#jump').append(' <option value="' + i + '">' + i + '</option>')
                            }
                        }, 100)
                    }

                })
            }
        }
    });

    //跳转
    $("#jumps").click(function () {
        var newArray = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            newArray[i] = $(".goods_name").eq(i).attr('goods_id')
        }
        var gys_name = $("#gys_name").attr('client_id');
        $.ajax({
            url: '/purchasepayment/get_purchase',
            type: 'POST',
            data: {
                id: $("#jump option:selected").val(),
                supplier_id: gys_name
            },
            beforeSend: function () {
                $('#ok').modal('show');
                $("#select_shop").modal('hide');
            },
            success: function (r, x, s) {
                $('#ok-img').attr('src', '../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');

                $('#next').attr('next', $("#jump option:selected").val());
                $('#prve').attr('prev', $("#jump option:selected").val());
                $("#next").parent().attr('class', '');
                $("#prve").parent().attr('class', '');
                $("#add-ok").children().remove()
                for (var i = 0; i < r.length; i++) {
                    if (!in_array(newArray, r[i]['id'])) {
                        $('#add-ok').append('  <tr>\n' +
                            '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + ($("#jump option:selected").val() - 1) * 10) + '</td>\n' +
                            '                                        <td>' + r[i]['document_number'] + '</td>\n' +
                            '                                        <td>' + r[i]['total_amount'] + '</td>\n' +
                            '                                        <td>' + r[i]['paid'] + '</td>\n' +
                            '                                        <td><a class="details" details_id="' + r[i]['id'] + '"><i class="fa fa-file-text-o"></i></a></td>\n' +
                            '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');
                    }
                }
                setTimeout(function () {
                    $("#select_shop").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                    $('#pages').attr('count', r.length)
                    //select
                    var counts = Math.ceil($("#pages").attr('count') / 10);
                    for (var i = 1; i <= counts; i++) {
                        $('#jump').append(' <option value="' + i + '">' + i + '</option>')
                    }
                }, 100)
            }
        })
    });

    //选择
    $("#add-ok").on('click', '.documentary', function () {
        var i = $("#select_shop").attr('test');
        for (var j = 0; j < $(".goods_name").length; j++) {
            if (i == $(".goods_name").eq(j).next().attr('test')) {
                $(".goods_name").eq(j).val($(this).parents(":eq(0)").children(":eq(1)").html());
                $(".goods_name").eq(j).attr('goods_id', $(this).parents(":eq(0)").children(":eq(0)").attr('staff_id'));
                var num1 = parseFloat($(this).parents(":eq(0)").children(":eq(2)").html());
                var num2 = parseFloat($(this).parents(":eq(0)").children(":eq(3)").html());
                $(".goods_name").eq(j).parents(":eq(3)").next().children().html(num1 - num2);
            }
        }
        $("#select_shop").modal('hide');
        $("#myModal").modal('show');
    });


    $("#add_row").on('blur', '.paid', function () {
        var unpaid_amount = parseFloat($(this).parents(":eq(3)").prev().children().text());
        var paid = parseFloat($(this).val());
        if (paid > unpaid_amount) {
            $(this).val(unpaid_amount);
        }
    });


    //add row
    //添加行
    $("#add_row").on('click', '.add_row', function () {
        var i = parseInt($(".add_shop").length) + 1;
        $("#add_row").append(' <tr>\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text"   class="form-control  goods_name" goods_id=""  readonly=""  style="background-color: white">\n' +
            '                                                <div class="input-group-addon add_shop" test="' + i + '" ><span class="glyphicon glyphicon-search"></span></div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="unpaid_amount"></div>\n' +
            '                                </td>\n' +
            '\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text" class="form-control  paid"  style="background-color: white">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="col-sm-12">\n' +
            '                                        <select class="form-control m-b selects  account_name" name="account">\n' +
            '                                            <option></option>\n' +

            '                                        </select>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="col-sm-12">\n' +
            '                                        <select class="form-control m-b select  settlement_name" name="settlement">\n' +
            '                                            <option></option>\n' +

            '                                        </select>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td>\n' +
            '                                    <a  class="btn btn-warning btn-sm  add_row"  type="button"><i class="glyphicon glyphicon-plus"></i> 新增行</a>\n' +
            '                                    <a class="btn btn-danger btn-sm remove_row" type="button"><i class="glyphicon glyphicon-trash"></i> 删除</a>\n' +
            '                                </td>\n' +
            '                            </tr>');

        $(".select").children().remove();
        for (var i = 0; i < yang.length; i++) {
            var yangs = JSON.parse(yang[i]);
            $(".select").append(' <option value="' + yangs['id'] + '">' + yangs['name'] + '</option>')
        }

        $(".selects").children().remove();
        for (var i = 0; i < yi.length; i++) {
            var yis = JSON.parse(yi[i]);
            $(".selects").append(' <option value="' + yis['id'] + '">' + yis['name'] + '</option>')
        }
    })


    //删除
    $("#add_row").on('click', '.remove_row', function () {
        $(this).parents(":eq(1)").remove();
    })

    $("#add_purchase_data").click(function () {
        var dataExtend = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            dataExtend[i] = '{"unpaid_amount":"' + $('.unpaid_amount').eq(i).text() + '","payment_amount":"' + $(".paid").eq(i).val() + '","order_id":"' + $(".goods_name").eq(i).attr('goods_id') + '","account_id":' + $(".account_name option:selected").eq(i).val() + ',"settlement_id":"' + $(".settlement_name option:selected").eq(i).val() + '"}';
        }

        $.ajax({
            url: "/purchasepayment",
            type: 'post',
            data: {
                data: dataExtend,
                details: $("#details").val(),  //备注信息
                unit_id: $("#gys_name").attr('client_id'), //供货商id
            },
            beforeSend: function () {
                $('#myModal').modal('hide');
                $('#ok').modal('show');
            },
            success: function (response, stutas, xhr) {
                if (response) {
                    $('#ok-img').attr('src', '../images/jump_success.png');
                    $('#ok-text').html('数据添加成功');
                    setTimeout(function () {
                        window.location.href = "/purchasepayment";
                    }, 100);
                }
            }

        })
    });

});
