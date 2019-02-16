$(function () {
    //laravel-config
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
            number: {
                maxlength: 10,
                minlength: 4,
                required: true,
                number: true,
                remote: {
                    url: '/client/checkUnique',
                    type: 'POST',
                    data: {
                        number: function () {
                            return $("#number").val()
                        },
                        id: function () {
                            return $("#client_id").val();
                        },
                        key: function () {
                            return 2;
                        }
                    }
                }
            },
            name: {
                maxlength: 20,
                minlength: 2,
                required: true,
                remote: {
                    url: '/client/checkUnique',
                    type: 'POST',
                    data: {
                        name: function () {
                            return $("#name").val()
                        },
                        id: function () {
                            return $("#client_id").val();
                        },
                        key: function () {
                            return 1;
                        }
                    }
                }
            },
            type: {
                required: true,
            },
            balance_date: {
                required: true,
            },
            initial_payable: {
                required: true,
                number: true,
                max: 999999
            },
            initial_advance_payment: {
                required: true,
                number: true,
                max: 999999
            },
            rate: {
                required: true,
                max: 100,
                number: true
            },
            contacts: {
                maxlength: 20,
                minlength: 2,
                required: true,
            },
            phone: {
                maxlength: 11,
                minlength: 11,
                required: true,
                number: true
            },
            landline: {
                maxlength: 11,
                minlength: 11,
                required: true,
                number: true
            },
            qq: {
                maxlength: 10,
                minlength: 6,
                required: true,
                number: true
            },
            address: {
                maxlength: 120,
                minlength: 2,
                required: true,
            },
            info: {
                maxlength: 120,
                minlength: 2,
                required: true,
            },
            level: {
                required: true,
            }

        },
        messages: {
            number: {
                remote: '商品编号已存在！',
            },
            name: {
                remote: '商品名称已存在！',
            },
        },
        submitHandler: function (form) {
            $.ajax({
                url: '/client/' + $("#client_id").val(),
                type: 'put',
                data: {
                    name: $("#name").val(),
                    level: $("#level option:selected").val(),
                    number: $("#number").val(),
                    type: $("#type option:selected").val(),
                    balance_date: $("#balance_date").val(),
                    initial_payable: $("initial_payable").val(),
                    initial_advance_payment: $("#initial_advance_payment").val(),
                    rate: $("#rate").val(),
                    contacts: $("#contacts").val(),
                    phone: $("#phone").val(),
                    landline: $("#landline").val(),
                    qq: $("#qq").val(),
                    address: $("#address").val(),
                    initial_payable: $("#initial_payable").val(),
                    info: $("#info").val()
                },
                beforeSend: function () {
                    $('#ok').modal('show');
                },
                success: function (r, s, x) {
                    if (r == 'true') {
                        $('#ok-img').attr('src', '../../images/jump_success.png');
                        $('#ok-text').html('数据添加成功');
                        setTimeout(function () {
                            window.location.href = "/client";
                        }, 100);
                    }
                }
            })
        }
    })

});
