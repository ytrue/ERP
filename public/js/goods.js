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


    $('#reg').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 10,
                remote: {
                    url: '/goods/checkUnique',
                    type: 'POST',
                    data: {
                        name: function () {
                            return $("#name").val()
                        },
                        id: function () {
                            return $("#goods_id").val();
                        },
                        key: function () {
                            return 1;
                        }
                    }

                }
            },
            number: {
                required: true,
                minlength: 4,
                maxlength: 20,
                remote: {
                    url: '/goods/checkUnique',
                    type: 'POST',
                    data: {
                        number: function () {
                            return $("#number").val()
                        },
                        id: function () {
                            return $("#goods_id").val();
                        },
                        key: function () {
                            return 2;
                        }
                    }

                }
            },
            bar_code: {
                required: true,
                minlength: 4,
                maxlength: 20,
                remote: {
                    url: '/goods/checkUnique',
                    type: 'POST',
                    data: {
                        number: function () {
                            return $("#bar_code").val()
                        },
                        id: function () {
                            return $("#goods_id").val();
                        },
                        key: function () {
                            return 3;
                        }
                    }

                }
            },
            specification: {
                required: true
            },
            type: {
                required: true
            },
            preferred: {
                required: true
            },
            minimum: {
                required: true,
                number: true
            },
            maximum: {
                required: true,
                number: true
            },
            measurement: {
                required: true
            },
            predicted_price: {
                required: true,
                number: true,
            },
            retail_price: {
                required: true,
                number: true,
            },
            wholesale_price: {
                required: true,
                number: true,
            },
            vip_price: {
                required: true,
                number: true,
            },
            discount_one: {
                required: true,
                number: true,
                max: 99,
            },
            discount_two: {
                required: true,
                number: true,
                max: 99
            }
        },
        messages: {
            name: {
                remote: '此商品名称已存在！',
            },
            number: {
                remote: '此商品编号已存在！',
            },
            bar_code: {
                remote: '此商品条码已存在！',
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: '/goods',
                type: 'post',
                data: {
                    name: $("#name").val(),
                    number: $("#number").val(),
                    bar_code: $("#bar_code").val(),
                    specification: $("#specification").val(),
                    type: $("#type option:selected").val(),
                    preferred: $("#preferred option:selected").val(),
                    minimum: $("#minimum").val(),
                    maxnum: $("#maximum").val(),
                    measurement: $("#measurement option:selected").val(),
                    predicted_price: $("#predicted_price").val(),
                    retail_price: $("#retail_price").val(),
                    wholesale_price: $("#wholesale_price").val(),
                    vip_price: $("#vip_price").val(),
                    discount_one: $("#discount_one").val(),
                    discount_two: $("#discount_two").val(),
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                },
                success: function (r, s, x) {
                    if (r == 'true') {
                        $('#ok-img').attr('src', '../images/jump_success.png');
                        $('#ok-text').html('数据添加成功');
                        setTimeout(function () {
                            window.location.href = "/goods";
                        }, 100);
                    }
                }
            })
        }
    })

});
