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
            name: {
                required: true,
                minlength: 2,
                maxlength: 10,
                remote: {
                    url: '/customer/checkUnique',
                    type: 'POST',
                    data: {
                        name: function () {
                            return $("#name").val()
                        },
                        id: function () {
                            return $("#customer_id").val();
                        }
                    }

                }
            },

        },
        messages: {
            name: {
                required: '内容不得为空！',
                minlength: '内容不得小于2位！',
                maxlength: '内容名称不得大于10位！',
                remote: '此结算方式名称已存在！',
            },
        },
    });

});
