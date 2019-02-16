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

    //add
    $('#reg').validate({
        rules: {
            number: {
                number: true,
                minlength: 4,
                maxlength: 10,
                required: true,
                remote: {
                    url: '/account/checkUnique',
                    type: 'POST',
                    data: {
                        number: function () {
                            return $("#number").val()
                        },
                        id: function () {
                            return $("#accounts_id").val();
                        },
                        key: function () {
                            return 2;
                        }
                    }

                }
            },
            name: {
                required: true,
                minlength: 2,
                maxlength: 20,
                remote: {
                    url: '/account/checkUnique',
                    type: 'POST',
                    data: {
                        name: function () {
                            return $("#name").val()
                        },
                        id: function () {
                            return $("#accounts_id").val();
                        },
                        key: function () {
                            return 1;
                        }
                    }

                }
            },
            balance_date: {
                required: true,
            },
            balance: {
                required: true,
                number: true
            },
            type: {
                required: true,
            }
        },
        messages: {
            number: {
                required: '账户编号不得为空！',
                minlength: '账户编号不得小于4位！',
                maxlength: '账户编号不得大于10位！',
                remote: '此编号名称已存在！',
            },
            name: {
                required: '内容不得为空！',
                minlength: '内容不得小于2位！',
                maxlength: '内容名称不得大于10位！',
                remote: '此账户名称已存在！',
            },
        },
    });

});
