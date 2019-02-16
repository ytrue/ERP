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
                    url: '/warehouse/checkUnique',
                    type: 'POST',
                    data: {
                        name: function () {
                            return $("#name").val()
                        },
                        id: function () {
                            return $("#warehouse_id").val();
                        },
                        key: function () {
                            return 1;
                        }
                    }

                }
            },
            number: {
                number: true,
                minlength: 4,
                maxlength: 10,
                required: true,
                remote: {
                    url: '/warehouse/checkUnique',
                    type: 'POST',
                    data: {
                        number: function () {
                            return $("#number").val()
                        },
                        id: function () {
                            return $("#warehouse_id").val();
                        },
                        key: function () {
                            return 2;
                        }
                    }

                }
            },

        },
        messages: {
            number: {
                required: '职员编号不得为空！',
                minlength: '职员编号不得小于4位！',
                maxlength: '职员编号不得大于10位！',
                remote: '此职员编号已存在！',
            },
            name: {
                required: '职员名称不得为空！',
                minlength: '职员名称不得小于2位！',
                maxlength: '职员名称不得大于10位！',
                remote: '此职员名称已存在！',
            },
        },
    });

    function yang() {
        alert(0)
    }

});
