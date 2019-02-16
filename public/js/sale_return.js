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
    var counts_client=Math.ceil($("#pages-client").attr('count')/10);
    for (var i = 1; i <= counts_client; i++){
        $('#jump-client').append(' <option value="'+i+'">'+i+'</option>')
    }

    //选择客户
    $("#add_gys").click(function () {
        $.ajax({
            url:'/sales/get_client',
            type:'POST',
            beforeSend:function(){
                $('#ok').modal('show');
                $("#myModal").modal('hide');
            },
            success:function (r,x,s) {
                $('#ok-img').attr('src','../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');
                $("#add-ok-client").children().remove();
                for (var i = 0; i < r.length; i++){
                    $('#add-ok-client').append('  <tr>\n' +
                        '                                      <td  client_id="'+r[i]['id']+'" >'+parseInt(i+1)+'</td>\n' +
                        '                                        <td>'+r[i]['number']+'</td>\n' +
                        '                                        <td>'+r[i]['type']+'</td>\n' +
                        '                                        <td>'+r[i]['name']+'</td>\n' +
                        '                                        <td>'+r[i]['contacts']+'</td>\n' +
                        '                                        <td>'+r[i]['phone']+'</td>\n' +
                        '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_client").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src','../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                },100)
            }

        })
    });
    //下一页
    $("#next-client").click(function () {
        var count=Math.ceil($("#pages-client").attr('count')/10);
        var i =parseInt($(this).attr('next'));
        var j=i+1;
        $("#prve-client").parent().removeClass('disabled');
        if (i < count){
            $(this).attr('next',j);
            $("#prve-client").attr('prev',j);
            $.ajax({
                url:'/purchase/get_data',
                type:'POST',
                data:{
                    id:j
                },
                beforeSend:function(){
                    $('#ok').modal('show');
                    $("#select_client").modal('hide');
                },
                success:function (r,x,s) {
                    $('#ok-img').attr('src','../images/jump_success.png');
                    $('#ok-text').html('数据交互成功!');
                    $("#add-ok-client").children().remove();
                    for (var i = 0; i < r.length; i++){
                        $('#add-ok-client').append('  <tr>\n' +
                            '                                      <td  client_id="'+r[i]['id']+'" >'+parseInt((i+1)+(j-1)*10)+'</td>\n' +
                            '                                        <td>'+r[i]['number']+'</td>\n' +
                            '                                        <td>'+r[i]['type']+'</td>\n' +
                            '                                        <td>'+r[i]['name']+'</td>\n' +
                            '                                        <td>'+r[i]['contacts']+'</td>\n' +
                            '                                        <td>'+r[i]['phone']+'</td>\n' +
                            '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');

                    }
                    setTimeout(function () {
                        $("#select_client").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src','../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    },100)
                }

            })
        } else {
            $(this).parent().addClass("disabled")
        }
    });

    //上一页
    $("#prve-client").click(function () {
        if ($(this).attr('prev') !='no'){
            var i =parseInt($(this).attr('prev'));
            var next=parseInt($("#next-client").attr('next'));
            var newNext=next-1;
            var j=i-1;
            $(this).attr('prev',j);
            $("#next-client").attr('next',newNext);
            if (i <= 1 ){
                $("#next-client").attr('next',newNext+1);
                $(this).parent().addClass('disabled')
                $(this).attr('prev','no');
            }else {
                $.ajax({
                    url:'/purchase/get_data',
                    type:'POST',
                    data:{
                        id:j
                    },
                    beforeSend:function(){
                        $('#ok').modal('show');
                        $("#select_client").modal('hide');
                    },
                    success:function (r,x,s) {
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据交互成功!');
                        $("#add-ok-client").children().remove()
                        for (var i = 0; i < r.length; i++){
                            $('#add-ok-client').append('  <tr>\n' +
                                '                                      <td  client_id="'+r[i]['id']+'" >'+parseInt((i+1)+(j-1)*10)+'</td>\n' +
                                '                                        <td>'+r[i]['number']+'</td>\n' +
                                '                                        <td>'+r[i]['type']+'</td>\n' +
                                '                                        <td>'+r[i]['name']+'</td>\n' +
                                '                                        <td>'+r[i]['contacts']+'</td>\n' +
                                '                                        <td>'+r[i]['phone']+'</td>\n' +
                                '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                        }
                        setTimeout(function () {
                            $("#select_client").modal('show');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中..,');
                        },100)
                    }

                })
            }
        }
    });


    //跳转
    $("#jumps-client").click(function () {
        $.ajax({
            url:'/purchase/get_data',
            type:'POST',
            data:{
                id:$("#jump-client option:selected").val(),
            },
            beforeSend:function(){
                $('#ok').modal('show');
                $("#select_client").modal('hide');
            },
            success:function (r,x,s) {
                $('#ok-img').attr('src','../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');

                $('#next-client').attr('next',$("#jump-client option:selected").val());
                $('#prve-client').attr('prev',$("#jump-client option:selected").val());
                $("#next-client").parent().attr('class','');
                $("#prve-client").parent().attr('class','');
                $("#add-ok-client").children().remove()
                for (var i = 0; i < r.length; i++){
                    $('#add-ok-client').append('  <tr>\n' +
                        '                                      <td  client_id="'+r[i]['id']+'" >'+ parseInt((i+1)+($("#jump-client option:selected").val()-1)*10)+'</td>\n' +
                        '                                        <td>'+r[i]['number']+'</td>\n' +
                        '                                        <td>'+r[i]['type']+'</td>\n' +
                        '                                        <td>'+r[i]['name']+'</td>\n' +
                        '                                        <td>'+r[i]['contacts']+'</td>\n' +
                        '                                        <td>'+r[i]['phone']+'</td>\n' +
                        '                                       <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_client").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src','../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                },100)
            }
        })
    });

    //选择
    $("#add-ok-client").on('click','.documentary',function () {
        $("#gys_name").val($(this).parents(":eq(0)").children(":eq(3)").html());
        $("#gys_name").attr('client_id',$(this).parents(":eq(0)").children(":eq(0)").attr('client_id'))
        $("#select_client").modal('hide');
        $("#myModal").modal('show');
    });

    //获得职员
    var counts_staff=Math.ceil($("#pages-staff").attr('count')/10);
    for (var i = 1; i <= counts_staff; i++){
        $('#jump-staff').append(' <option value="'+i+'">'+i+'</option>')
    }
    //选择职员
    $("#add_xsry").click(function () {
        $.ajax({
            url:'/sales/get_staff',
            type:'POST',
            beforeSend:function(){
                $('#ok').modal('show');
                $("#myModal").modal('hide');
            },
            success:function (r,x,s) {
                $('#ok-img').attr('src','../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');
                $("#add-ok-staff").children().remove();
                for (var i = 0; i < r.length; i++){
                    $('#add-ok-staff').append('  <tr>\n' +
                        '                                      <td  client_id="'+r[i]['id']+'" >'+parseInt(i+1)+'</td>\n' +
                        '                                        <td>'+r[i]['number']+'</td>\n' +
                        '                                        <td>'+r[i]['name']+'</td>\n' +
                        '                                       <td  style="cursor:pointer" class="staff"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_staff").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src','../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                },100)
            }

        })
    });


    //下一页
    $("#next-staff").click(function () {
        var count=Math.ceil($("#pages-staff").attr('count')/10);
        var i =parseInt($(this).attr('next'));
        var j=i+1;
        $("#prve-staff").parent().removeClass('disabled');
        if (i < count){
            $(this).attr('next',j);
            $("#prve-staff").attr('prev',j);
            $.ajax({
                url:'/sales/get_staff',
                type:'POST',
                data:{
                    id:j
                },
                beforeSend:function(){
                    $('#ok').modal('show');
                    $("#select_staff").modal('hide');
                },
                success:function (r,x,s) {
                    $('#ok-img').attr('src','../images/jump_success.png');
                    $('#ok-text').html('数据交互成功!');
                    $("#add-ok-staff").children().remove();
                    for (var i = 0; i < r.length; i++){
                        $('#add-ok-staff').append('  <tr>\n' +
                            '                                      <td  staff_id="'+r[i]['id']+'" >'+parseInt((i+1)+(j-1)*10)+'</td>\n' +
                            '                                        <td>'+r[i]['number']+'</td>\n' +
                            '                                        <td>'+r[i]['name']+'</td>\n' +
                            '                                       <td  style="cursor:pointer" class="staff"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');

                    }
                    setTimeout(function () {
                        $("#select_staff").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src','../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    },100)
                }

            })
        } else {
            $(this).parent().addClass("disabled")
        }
    });

    //上一页
    $("#prve-staff").click(function () {
        if ($(this).attr('prev') !='no'){
            var i =parseInt($(this).attr('prev'));
            var next=parseInt($("#next-staff").attr('next'));
            var newNext=next-1;
            var j=i-1;
            $(this).attr('prev',j);
            $("#next-staff").attr('next',newNext);
            if (i <= 1 ){
                $("#next-staff").attr('next',newNext+1);
                $(this).parent().addClass('disabled')
                $(this).attr('prev','no');
            }else {
                $.ajax({
                    url:'/sales/get_staff',
                    type:'POST',
                    data:{
                        id:j
                    },
                    beforeSend:function(){
                        $('#ok').modal('show');
                        $("#select_staff").modal('hide');
                    },
                    success:function (r,x,s) {
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据交互成功!');
                        $("#add-ok-staff").children().remove()
                        for (var i = 0; i < r.length; i++){
                            $('#add-ok-staff').append('  <tr>\n' +
                                '                                      <td  staff_id="'+r[i]['id']+'" >'+parseInt((i+1)+(j-1)*10)+'</td>\n' +
                                '                                        <td>'+r[i]['number']+'</td>\n' +
                                '                                        <td>'+r[i]['name']+'</td>\n' +
                                '                                       <td  style="cursor:pointer" class="staff"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                        }
                        setTimeout(function () {
                            $("#select_staff").modal('show');
                            $('#ok').modal('hide');
                            $('#ok-img').attr('src','../images/loading.gif');
                            $('#ok-text').html('数据交互中..,');
                        },100)
                    }

                })
            }
        }
    });

    //跳转
    $("#jumps-staff").click(function () {
        $.ajax({
            url:'/sales/get_staff',
            type:'POST',
            data:{
                id:$("#jump-staff option:selected").val(),
            },
            beforeSend:function(){
                $('#ok').modal('show');
                $("#select_staff").modal('hide');
            },
            success:function (r,x,s) {
                $('#ok-img').attr('src','../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');

                $('#next-staff').attr('next',$("#jump-staff option:selected").val());
                $('#prve-staff').attr('prev',$("#jump-staff option:selected").val());
                $("#next-staff").parent().attr('class','');
                $("#prve-staff").parent().attr('class','');
                $("#add-ok-staff").children().remove()
                for (var i = 0; i < r.length; i++){
                    $('#add-ok-staff').append('  <tr>\n' +
                        '                                      <td  staff_id="'+r[i]['id']+'" >'+ parseInt((i+1)+($("#jump-staff option:selected").val()-1)*10)+'</td>\n' +
                        '                                        <td>'+r[i]['number']+'</td>\n' +
                        '                                        <td>'+r[i]['name']+'</td>\n' +
                        '                                       <td  style="cursor:pointer" class="staff"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_staff").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src','../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                },100)
            }
        })
    });

    //选择
    $("#add-ok-staff").on('click','.staff',function () {
        $("#xsry_name").val($(this).parents(":eq(0)").children(":eq(2)").html());
        $("#xsry_name").attr('staff_id',$(this).parents(":eq(0)").children(":eq(0)").attr('client_id'))
        $("#select_staff").modal('hide');
        $("#myModal").modal('show');
    });

    //商品
    //select
    var counts=Math.ceil($("#pages").attr('count')/10);
    for (var i = 1; i <= counts; i++){
        $('#jump').append(' <option value="'+i+'">'+i+'</option>')
    }
    //添加商品
    $("#add_row").on('click','.add_shop', function () {
        var gys_name = $("#gys_name").attr('client_id');
        if (gys_name){
            $("#select_shop").attr('test',$(this).attr('test'));
            $.ajax({
                url:'/purchase/get_shop',
                type:'POST',
                beforeSend:function(){
                    $('#ok').modal('show');
                    $("#myModal").modal('hide');
                },
                success:function (r,x,s) {
                    $('#ok-img').attr('src','../images/jump_success.png');
                    $('#ok-text').html('数据交互成功！');
                    $("#add-ok").children().remove();
                    for (var i = 0; i < r.length; i++){
                        $('#add-ok').append('  <tr>\n' +
                            '                                        <td  staff_id="'+r[i]['id']+'" >'+parseInt(i+1)+'</td>\n' +
                            '                                        <td>'+r[i]['number']+'</td>\n' +
                            '                                        <td>'+r[i]['name']+'</td>\n' +
                            '                                        <td>'+r[i]['predicted_price']+'</td>\n' +
                            '                                        <td>'+r[i]['specification']+'</td>\n' +
                            '                                        <td>'+r[i]['measurement']+'</td>\n' +
                            '                                        <td>'+r[i]['current_inventory']+'</td>\n' +
                            '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src','../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    },100)
                }

            })
        } else {
            swal({title: "error", text: "请先选择供应商", type: "error"})
        }
    });
    //下一页
    $("#next").click(function () {
        var count=Math.ceil($("#pages").attr('count')/10);
        var i =parseInt($(this).attr('next'));
        var j=i+1;
        $("#prve").parent().removeClass('disabled');
        if (i < count){
            $(this).attr('next',j);
            $("#prve").attr('prev',j);
            $.ajax({
                url:'/purchase/get_shop',
                type:'POST',
                data:{
                    id:j
                },
                beforeSend:function(){
                    $('#ok').modal('show');
                    $("#select_shop").modal('hide');
                },
                success:function (r,x,s) {
                    $('#ok-img').attr('src','../images/jump_success.png');
                    $('#ok-text').html('数据交互成功!');
                    $("#add-ok").children().remove();
                    for (var i = 0; i < r.length; i++){
                        $('#add-ok').append('  <tr>\n' +
                            '                                        <td  staff_id="'+r[i]['id']+'" >'+ parseInt((i+1)+(j-1)*10) +'</td>\n' +
                            '                                        <td>'+r[i]['number']+'</td>\n' +
                            '                                        <td>'+r[i]['name']+'</td>\n' +
                            '                                        <td>'+r[i]['predicted_price']+'</td>\n' +
                            '                                        <td>'+r[i]['specification']+'</td>\n' +
                            '                                        <td>'+r[i]['measurement']+'</td>\n' +
                            '                                        <td>'+r[i]['current_inventory']+'</td>\n' +
                            '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                            '                                    </tr>');
                    }
                    setTimeout(function () {
                        $("#select_shop").modal('show');
                        $('#ok').modal('hide');
                        $('#ok-img').attr('src','../images/loading.gif');
                        $('#ok-text').html('数据交互中..,');
                    },100)
                }

            })
        } else {
            $(this).parent().addClass("disabled")
        }
    });


    //上一页
    $("#prve").click(function () {
        if ($(this).attr('prev') !='no'){
            var i =parseInt($(this).attr('prev'));
            var next=parseInt($("#next").attr('next'));
            var newNext=next-1;
            var j=i-1;
            $(this).attr('prev',j);
            $("#next").attr('next',newNext);
            if (i <= 1 ){
                $("#next").attr('next',newNext+1);
                $(this).parent().addClass('disabled')
                $(this).attr('prev','no');
            }else {
                $.ajax({
                    url:'/purchase/get_shop',
                    type:'POST',
                    data:{
                        id:j
                    },
                    beforeSend:function(){
                        $('#ok').modal('show');
                        $("#select_shop").modal('hide');
                    },
                    success:function (r,x,s) {
                        $('#ok-img').attr('src','../images/jump_success.png');
                        $('#ok-text').html('数据交互成功!');
                        $("#add-ok").children().remove()
                        for (var i = 0; i < r.length; i++){
                            $('#add-ok').append('  <tr>\n' +
                                '                                        <td  staff_id="'+r[i]['id']+'" >'+ parseInt((i+1)+(j-1)*10) +'</td>\n' +
                                '                                        <td>'+r[i]['number']+'</td>\n' +
                                '                                        <td>'+r[i]['name']+'</td>\n' +
                                '                                        <td>'+r[i]['predicted_price']+'</td>\n' +
                                '                                        <td>'+r[i]['specification']+'</td>\n' +
                                '                                        <td>'+r[i]['measurement']+'</td>\n' +
                                '                                        <td>'+r[i]['current_inventory']+'</td>\n' +
                                '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                                '                                    </tr>');
                            setTimeout(function () {
                                $("#select_shop").modal('show');
                                $('#ok').modal('hide');
                                $('#ok-img').attr('src','../images/loading.gif');
                                $('#ok-text').html('数据交互中..,');
                            },100)
                        }
                    }

                })
            }
        }
    });



    //跳转
    $("#jumps").click(function () {
        $.ajax({
            url:'/purchase/get_shop',
            type:'POST',
            data:{
                id:$("#jump option:selected").val(),
            },
            beforeSend:function(){
                $('#ok').modal('show');
                $("#select_shop").modal('hide');
            },
            success:function (r,x,s) {
                $('#ok-img').attr('src','../images/jump_success.png');
                $('#ok-text').html('数据交互成功！');

                $('#next').attr('next',$("#jump option:selected").val());
                $('#prve').attr('prev',$("#jump option:selected").val());
                $("#next").parent().attr('class','');
                $("#prve").parent().attr('class','');
                $("#add-ok").children().remove()
                for (var i = 0; i < r.length; i++){
                    $('#add-ok').append('  <tr>\n' +
                        '                                        <td  staff_id="'+r[i]['id']+'" >'+ parseInt((i+1)+($("#jump option:selected").val()-1)*10)+'</td>\n' +
                        '                                        <td>'+r[i]['number']+'</td>\n' +
                        '                                        <td>'+r[i]['name']+'</td>\n' +
                        '                                        <td>'+r[i]['predicted_price']+'</td>\n' +
                        '                                        <td>'+r[i]['specification']+'</td>\n' +
                        '                                        <td>'+r[i]['measurement']+'</td>\n' +
                        '                                        <td>'+r[i]['current_inventory']+'</td>\n' +
                        '                                        <td  style="cursor:pointer" class="documentary"><span class="glyphicon glyphicon-ok"> 选择</span></td>\n' +
                        '                                    </tr>');
                }
                setTimeout(function () {
                    $("#select_shop").modal('show');
                    $('#ok').modal('hide');
                    $('#ok-img').attr('src','../images/loading.gif');
                    $('#ok-text').html('数据交互中..,');
                },100)
            }
        })
    });
//选择
    $("#add-ok").on('click','.documentary',function () {
        var i = $("#select_shop").attr('test');
        for (var j = 0; j < $(".goods_name").length; j++){
            if (i == $(".goods_name").eq(j).next().attr('test')){
                $(".goods_name").eq(j).val($(this).parents(":eq(0)").children(":eq(2)").html());
                $(".goods_name").eq(j).attr('goods_id',$(this).parents(":eq(0)").children(":eq(0)").attr('staff_id'))
                $(".goods_name").eq(j).parents(":eq(3)").next().children().html($(this).parents(":eq(0)").children(":eq(5)").html());
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(3)").children().children().children().children().val($(this).parents(":eq(0)").children(":eq(3)").html());
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(2)").children().children().children().children().val(1);
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(4)").children().children().children().children().val(0);
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(5)").children().html(0);
                $(".goods_name").eq(j).parents(":eq(3)").nextAll(":eq(6)").children().html($(this).parents(":eq(0)").children(":eq(3)").html());
            }
        }


        //总数量
        var num =  $('#sum_number').html();
        if (num == ""){
            $("#sum_number").html(1);
        }else {
            $("#sum_number").html(parseInt(num)+1);
        }

        //总金额
        var num02 =0;
        for (var i = 0; i < $(".purchase_amount").length; i++){
            num02+=parseInt($(".purchase_amount").eq(i).html());
        }
        $("#sum_purchase_amount").html(num02);

        //总折扣
        var num03 =0;
        for (var i = 0; i < $(".zke").length; i++){
            num03+=parseInt($(".zke").eq(i).html());
        }
        $("#sum_zke").html(num03);

        //数量
        var num=0;
        for (var i = 0; i< $(".number").length; i++){
            num+=parseInt($(".number").eq(i).val());
        }
        $("#sum_number").html(num);



        var preferential_rate = $("#preferential_rate").val();
        if (preferential_rate == 0){
            $("#yhhje").val(num02);
            $("#yhje").val(0);
            $("#bcqk").val(num02);
        }else {
            $("#yhhje").val(num02 * (preferential_rate/100));
            $("#yhje").val(num02-(num02 * (preferential_rate/100)));
            $("#bcqk").val(num02 * (preferential_rate/100));
        }

        $("#select_shop").modal('hide');
        $("#myModal").modal('show');

    });
    //计算数量
    $("#add_row").on('blur','.number',function () {
        // alert($(this).val())
        //获得购货单价
        var data = 0;
        var number =parseInt($(this).val());
        var unit_purchase_price = parseInt($(this).parents(":eq(3)").next().children().children().children().children().val());
        var discount_rate = parseInt($(this).parents(":eq(3)").next().next().children().children().children().children().val());
        if (discount_rate == 0){
            data = (number* unit_purchase_price);
        } else {
            data = (number* unit_purchase_price* (discount_rate/100));
        }
        var test = (number*unit_purchase_price);
        var test01 = test-data;
        $(this).parents(":eq(3)").nextAll(":eq(2)").children().html(test01);
        $(this).parents(":eq(3)").nextAll(":eq(3)").children().html(data);

        var num=0;
        for (var i = 0; i< $(".number").length; i++){
            num+=parseInt($(".number").eq(i).val());
        }
        $("#sum_number").html(num);

        //计算总额度
        var num02 =0;
        for (var i = 0; i < $(".purchase_amount").length; i++){
            num02+=parseInt($(".purchase_amount").eq(i).html());
        }
        $("#sum_purchase_amount").html(num02);


        var preferential_rate = $("#preferential_rate").val();
        if (preferential_rate == 0){
            var $test = $("#yhhje").val(num02);
            $("#yhje").val(0);
            $("#bcqk").val(num02);
        }else {
            var $test = $("#yhhje").val(num02 * (preferential_rate/100));
            $("#yhje").val(num02-(num02 * (preferential_rate/100)));
            $("#bcqk").val(num02 * (preferential_rate/100));
        }

        //欠款



        //总折扣
        var num03 =0;
        for (var i = 0; i < $(".zke").length; i++){
            num03+=parseInt($(".zke").eq(i).html());
        }
        $("#sum_zke").html(num03);

    });

    //计算购货单价
    $("#add_row").on('blur','.unit_purchase_price',function () {
        var data = 0;
        var unit_purchase_price =parseInt($(this).val());
        var number = parseInt($(this).parents(":eq(3)").prev().children().children().children().children().val());
        var discount_rate = parseInt($(this).parents(":eq(3)").next().children().children().children().children().val());
        if (discount_rate == 0){
            data = (number* unit_purchase_price);
        } else {
            data = (number* unit_purchase_price* (discount_rate/100));
        }
        var test = (number*unit_purchase_price);
        var test01 = test-data;
        $(this).parents(":eq(3)").nextAll(":eq(1)").children().html(test01);

        $(this).parents(":eq(3)").nextAll(":eq(2)").children().html(data);

        //计算总额度
        var num02 =0;
        for (var i = 0; i < $(".purchase_amount").length; i++){
            num02+=parseInt($(".purchase_amount").eq(i).html());
        }
        $("#sum_purchase_amount").html(num02);


        var preferential_rate = $("#preferential_rate").val();
        if (preferential_rate == 0){
            $("#yhhje").val(num02);
            $("#yhje").val(0);
            $("#bcqk").val(num02);
        }else {
            var $test = $("#yhhje").val(num02 * (preferential_rate/100));
            $("#yhje").val(num02-(num02 * (preferential_rate/100)));
            $("#bcqk").val(num02 * (preferential_rate/100));

        }

        //总折扣
        var num03 =0;
        for (var i = 0; i < $(".zke").length; i++){
            num03+=parseInt($(".zke").eq(i).html());
        }
        $("#sum_zke").html(num03);
    });


    //计算折扣额度
    $("#add_row").on('blur','.discount_rate',function () {
        var data = 0;
        var discount_rate = parseInt($(this).val());
        var number = parseInt($(this).parents(":eq(3)").prevAll(":eq(1)").children().children().children().children().val());
        var unit_purchase_price = parseInt($(this).parents(":eq(3)").prevAll(":eq(0)").children().children().children().children().val());
        if (discount_rate == 0){
            data = (number* unit_purchase_price);
        } else {
            data = (number* unit_purchase_price* (discount_rate/100));
        }
        var test = (number*unit_purchase_price);
        var test01 = test-data;
        $(this).parents(":eq(3)").nextAll(":eq(0)").children().html(test01);
        $(this).parents(":eq(3)").nextAll(":eq(1)").children().html(data);
        //计算总额度
        var num02 =0;
        for (var i = 0; i < $(".purchase_amount").length; i++){
            num02+=parseInt($(".purchase_amount").eq(i).html());
        }
        $("#sum_purchase_amount").html(num02);

        //总折扣
        var num03 =0;
        for (var i = 0; i < $(".zke").length; i++){
            num03+=parseInt($(".zke").eq(i).html());
        }
        $("#sum_zke").html(num03);



        var preferential_rate = $("#preferential_rate").val();
        if (preferential_rate == 0){
            $("#yhhje").val(num02);
            $("#yhje").val(0);
            $("#bcqk").val(num02);
        }else {
            var $test = $("#yhhje").val(num02 * (preferential_rate/100));
            $("#yhje").val(num02-(num02 * (preferential_rate/100)));
            $("#bcqk").val(num02 * (preferential_rate/100));

        }

    });


    $("#preferential_rate").blur(function () {
        var preferential_rate = $(this).val();
        var num02 = $("#sum_purchase_amount").html();
        if (preferential_rate == 0){
            $("#yhhje").val(num02);
            $("#yhje").val(0);
            $("#bcqk").val(num02);
        }else {
            var $test = $("#yhhje").val(num02 * (preferential_rate/100));
            $("#yhje").val(num02-(num02 * (preferential_rate/100)));
            $("#bcqk").val(num02 * (preferential_rate/100));

        }
    });

    $("#paid").blur(function () {
        var paid =parseFloat($(this).val());
        var yhhje =parseFloat($("#yhhje").val());
        if (paid > yhhje){
            $(this).val(yhhje);
            $("#bcqk").val(0);
        }else {
            $("#bcqk").val(paid - yhhje);
        }

    });

    //删除
    $("#add_row").on('click','.remove_row',function () {
        $(this).parents(":eq(1)").remove();
        var purchase_amount = $(this).parents(":eq(0)").prev().children().html();
        var zke =  $(this).parents(":eq(0)").prevAll(":eq(1)").children().html();
        var number =  $(this).parents(":eq(0)").prevAll(":eq(4)").children().children().children().children().val();
        var sum_number = $("#sum_number").html( $("#sum_number").html()-number);
        var sum_zek = $("#sum_zke").html( $("#sum_zke").html() - zke);
        var sum_purchase_amount = $("#sum_purchase_amount").html($("#sum_purchase_amount").html() -purchase_amount);
    });

    //添加行
    $("#add_row").on('click','.add_row',function () {
        var i = parseInt($(".add_shop").length)+1;
        $("#add_row").append('   <tr>\n' +
            '                                <td style="width: 200px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text"   class="form-control  goods_name" goods_id=""  readonly="" style="background-color: white">\n' +
            '                                                <div class="input-group-addon add_shop" test="'+i+'" ><span class="glyphicon glyphicon-search"></span></div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="company"></div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 200px;">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <select class="form-control m-b select warehouse_name" name="account">\n' +
            '                                                <option>选项 1</option>\n' +
            '                                            </select>\n' +
            '                                        </div>\n' +
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
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text" class="form-control  unit_purchase_price"  style="background-color: white">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="form-group">\n' +
            '                                        <div class="col-sm-12">\n' +
            '                                            <div class=" input-group">\n' +
            '                                                <input type="text" class="form-control  discount_rate"  style="background-color: white">\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;">\n' +
            '                                    <div class="zke"></div>\n' +
            '                                </td>\n' +
            '\n' +
            '                                <td style="width: 100px;"  >\n' +
            '                                    <div class="purchase_amount"></div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <a  class="btn btn-warning btn-sm  add_row"  type="button"><i class="glyphicon glyphicon-plus"></i> 新增行</a>\n' +
            '                                    <a class="btn btn-danger btn-sm  remove_row" type="button"><i class="glyphicon glyphicon-trash "></i> 删除</a>\n' +
            '                                </td>\n' +
            '                            </tr>');

        $(".select").children().remove();
        for (var i = 0 ; i < yang.length; i++ )
        {
            var yi =JSON.parse(yang[i]);
            $(".select").append(' <option value="'+yi['id']+'"  warehouse_id="'+yi['id']+'">'+yi['name']+'</option>')
        }
    });



    $("#add_purchase_data").click(function () {
        var dataExtend = [];
        for (var i = 0; i < $(".goods_name").length ; i++){
            dataExtend[i] = '{"goods_name":"'+$(".goods_name").eq(i).val()+'","goods_id":"'+$(".goods_name").eq(i).attr('goods_id')+'","warehouse_id":"'+$(".warehouse_name option:selected").eq(i).val()+'","number":"'+$('.number').eq(i).val()+'","company":"'+$(".company").eq(i).text()+'","unit_purchase_price":"'+$(".unit_purchase_price").eq(i).val()+'","discount_rate":"'+$(".discount_rate").eq(i).val()+'","purchase_amount":"'+$(".purchase_amount").eq(i).text()+'"}';
        }
        $.ajax({
            url:"/salereturn",
            type:'post',
            data:{
                client_name:$("#gys_name").val(),   //供货商名称
                client_id:$("#gys_name").attr('client_id'), //供货商id
                preferential_rate:$("#preferential_rate").val(), //优惠率
                paid:$("#paid").val(),  //以付款
                settlement_account:$("#settlement_account option:selected").val(),  //结算账号
                details:$("#details").val(),  //备注信息
                staff_name:$("#xsry_name").val(),
                staff_id:$("#xsry_name").attr('staff_id'),
                data:dataExtend
            },
            beforeSend:function(){
                $('#myModal').modal('hide');
                $('#ok').modal('show');
            },
            success:function (response,stutas,xhr) {
                if(response){
                    $('#ok-img').attr('src','../images/jump_success.png');
                    $('#ok-text').html('数据添加成功');
                    setTimeout(function () {
                        window.location.href="/salereturn";
                    },100);
                }
             }
        });
    })



});
