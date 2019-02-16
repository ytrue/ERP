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


    //仓库
    $("#add_row").on('click', '.add_warehouse', function () {
        $("#select_warehouse").attr('test', $(this).attr('test'));
        $.ajax({
            url: '/purchasereturns/get_warehouse',
            type: 'POST',

            beforeSend: function () {
                $('#ok').modal('show');
                $("#myModal").modal('hide');
            },
            success: function (r, x, s) {
                $('#ok-img').attr('src', '../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');
                $("#add-ok-warehouse").children().remove();
                for (var i = 0; i < r.length; i++) {
                    $('#add-ok-warehouse').append('  <tr>\n' +
                        '                                        <td  warehouse_id="' + r[i]['id'] + '" >' + parseInt(i + 1) + '</td>\n' +
                        '                                        <td>' + r[i]['number'] + '</td>\n' +
                        '                                        <td>' + r[i]['name'] + '</td>\n' +
                        '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_warehouse").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                }, 100)
            }

        })


    });

    //选择
    $("#add-ok-warehouse").on('click', '.documentary', function () {
        var i = $("#select_warehouse").attr('test');
        for (var j = 0; j < $(".warehouse_name").length; j++) {
            if (i == $(".warehouse_name").eq(j).next().attr('test')) {
                $(".warehouse_name").eq(j).val($(this).parents(":eq(0)").children(":eq(2)").html());
                $(".warehouse_name").eq(j).attr('warehouse_id', $(this).parents(":eq(0)").children(":eq(0)").attr('warehouse_id'))
            }
        }

        $("#select_warehouse").modal('hide');
        $("#myModal").modal('show');
    });


    //添加商品
    $("#add_row").on('click', '.add_shop', function () {
        var warehouse_id = $(this).parents(":eq(3)").prev().children().children().children().children().attr('warehouse_id');
        if (warehouse_id) {
            $("#select_shop").attr('test', $(this).attr('test'));
            $.ajax({
                url: '/purchasereturns/get_shop',
                type: 'POST',
                data: {
                    // supplier_management_id:gys_name,
                    warehouse_id: warehouse_id
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
                        $('#add-ok').append('  <tr>\n' +
                            '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt(i + 1) + '</td>\n' +
                            '                                        <td>' + r[i]['number'] + '</td>\n' +
                            '                                        <td>' + r[i]['name'] + '</td>\n' +
                            '                                        <td>' + r[i]['predicted_price'] + '</td>\n' +
                            '                                        <td>' + r[i]['specification'] + '</td>\n' +
                            '                                        <td>' + r[i]['measurement'] + '</td>\n' +
                            '                                        <td>' + r[i]['current_inventory'] + '</td>\n' +
                            '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src', '../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    }, 100)
                }

            })
        } else {
            swal({title: "error", text: "请先选择仓库", type: "error"})
        }
    });

    //下一页
    $("#next").click(function () {
        var gys_name = $("#gys_name").attr('client_id');
        var count = Math.ceil($("#pages").attr('count') / 10);
        var i = parseInt($(this).attr('next'));
        var j = i + 1;
        $("#prve").parent().removeClass('disabled');
        if (i < count) {
            $(this).attr('next', j);
            $("#prve").attr('prev', j);
            $.ajax({
                url: '/purchasereturns/get_shop',
                type: 'POST',
                data: {
                    id: j,
                    supplier_management_id: gys_name,
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
                        $('#add-ok').append('  <tr>\n' +
                            '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                            '                                        <td>' + r[i]['number'] + '</td>\n' +
                            '                                        <td>' + r[i]['name'] + '</td>\n' +
                            '                                        <td>' + r[i]['predicted_price'] + '</td>\n' +
                            '                                        <td>' + r[i]['specification'] + '</td>\n' +
                            '                                        <td>' + r[i]['measurement'] + '</td>\n' +
                            '                                        <td>' + r[i]['current_inventory'] + '</td>\n' +
                            '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
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
    $("#prve").click(function () {
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
                    url: '/purchasereturns/get_shop',
                    type: 'POST',
                    data: {
                        id: j,
                        supplier_management_id: gys_name,
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
                            $('#add-ok').append('  <tr>\n' +
                                '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + (j - 1) * 10) + '</td>\n' +
                                '                                        <td>' + r[i]['number'] + '</td>\n' +
                                '                                        <td>' + r[i]['name'] + '</td>\n' +
                                '                                        <td>' + r[i]['predicted_price'] + '</td>\n' +
                                '                                        <td>' + r[i]['specification'] + '</td>\n' +
                                '                                        <td>' + r[i]['measurement'] + '</td>\n' +
                                '                                        <td>' + r[i]['current_inventory'] + '</td>\n' +
                                '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                            setTimeout(function () {
                                $("#select_shop").modal('show');
                                $('#ok').modal('hide');
                                $('#ok-img').attr('src', '../images/loading.gif');
                                $('#ok-text').html('数据交互中..,');
                            }, 100)
                        }
                    }

                })
            }
        }
    });


    //跳转
    $("#jumps").click(function () {
        var gys_name = $("#gys_name").attr('client_id');
        $.ajax({
            url: '/purchasereturns/get_shop',
            type: 'POST',
            data: {
                id: $("#jump option:selected").val(),
                supplier_management_id: gys_name,
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
                    $('#add-ok').append('  <tr>\n' +
                        '                                        <td  staff_id="' + r[i]['id'] + '" >' + parseInt((i + 1) + ($("#jump option:selected").val() - 1) * 10) + '</td>\n' +
                        '                                        <td>' + r[i]['number'] + '</td>\n' +
                        '                                        <td>' + r[i]['name'] + '</td>\n' +
                        '                                        <td>' + r[i]['predicted_price'] + '</td>\n' +
                        '                                        <td>' + r[i]['specification'] + '</td>\n' +
                        '                                        <td>' + r[i]['measurement'] + '</td>\n' +
                        '                                        <td>' + r[i]['current_inventory'] + '</td>\n' +
                        '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_shop").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src', '../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                }, 100)
            }
        })
    });
    //选择
    $("#add-ok").on('click', '.documentary', function () {
        var i = $("#select_shop").attr('test');
        for (var j = 0; j < $(".goods_name").length; j++) {
            if (i == $(".goods_name").eq(j).next().attr('test')) {
                $(".goods_name").eq(j).val($(this).parents(":eq(0)").children(":eq(2)").html());
                $(".goods_name").eq(j).attr('goods_id', $(this).parents(":eq(0)").children(":eq(0)").attr('staff_id'))
                $(".goods_name").eq(j).parents(":eq(3)").next().children().html($(this).parents(":eq(0)").children(":eq(5)").html());
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(1)").children().children().children().children().val(1);
            }
        }

        $("#select_shop").modal('hide');
        $("#myModal").modal('show');

    });

    //删除
    $("#add_row").on('click', '.remove_row', function () {
        $(this).parents(":eq(1)").remove();
    });
    //添加行
    $("#add_row").on('click', '.add_row', function () {
        var i = parseInt($(".add_shop").length) + 1;
        $("#add_row").append('    <tr>\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text"   class="form-control  warehouse_name" warehouse_id=""  readonly=""  style="background-color: white">\n' +
            '                                                <div class="input-group-addon add_warehouse"  test="' + i + '"  ><span class="glyphicon glyphicon-search"></span></div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text"   class="form-control  goods_name" goods_id=""  readonly=""  style="background-color: white">\n' +
            '                                                <div class="input-group-addon add_shop"  test="' + i + '"  ><span class="glyphicon glyphicon-search"></span></div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="company"></div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text" class="form-control  number"  style="background-color: white">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <select class="form-control m-b select in_warehouse" name="in_warehouse">\n' +
            '                                                <option></option>\n' +
            '                                            </select>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                <td>\n' +
            '                                    <a  class="btn btn-warning btn-sm  add_row"  type="button"><i class="glyphicon glyphicon-plus"></i> 新增行</a>\n' +
            '                                    <a class="btn btn-danger btn-sm remove_row" type="button"><i class="glyphicon glyphicon-trash"></i> 删除</a>\n' +
            '                                </td>\n' +
            '                            </tr>');

        $(".select").children().remove();
        for (var i = 0; i < yang.length; i++) {
            var yi = JSON.parse(yang[i]);
            $(".select").append(' <option value="' + yi['id'] + '"  warehouse_id="' + yi['id'] + '">' + yi['name'] + '</option>')
        }
    });


    $("#add_purchase_data").click(function () {
        var dataExtend = [];
        for (var i = 0; i < $(".goods_name").length; i++) {
            dataExtend[i] = '{"in_warehouse":"' + $(".in_warehouse option:selected").eq(i).val() + '","goods_id":"' + $(".goods_name").eq(i).attr('goods_id') + '","out_warehouse":"' + $(".warehouse_name").eq(i).attr('warehouse_id') + '","number":"' + $('.number').eq(i).val() + '","company":"' + $(".company").eq(i).text() + '"}';
        }

        $.ajax({
            url: "/allocation",
            type: 'post',
            data: {
                data: dataExtend,
                details: $("#details").val(),  //备注信息
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
                        window.location.href = "/allocation";
                    }, 100);
                }
            }
        });
    })


})
