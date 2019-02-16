$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//删除时候确认
function jump(url, id) {
    $(document).ready(function () {
        swal({
                title: "您确定要删除这条信息吗",
                text: "删除后将无法恢复，请谨慎操作！",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的，我要删除！",
                cancelButtonText: "让我再考虑一下…",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                var ids = [];
                ids[0] = id;
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            id: JSON.stringify(ids)
                        },

                        beforeSend: function () {
                            $('#ok').modal('show');
                        },
                        success: function (r, s, x) {
                            if (r == 'true') {
                                $('#ok-img').attr('src', '../images/jump_success.png');
                                $('#ok-text').html('数据添加成功');
                                setTimeout(function () {
                                    $("[yang=yang]:checkbox:checked").attr('checked', false);
                                    window.location.reload()
                                }, 100);
                            }else{
                                $('#ok-img').attr('src', '../images/jump_error.png');
                                $('#ok-text').html(r);
                                setTimeout(function () {
                                    $("[yang=yang]:checkbox:checked").attr('checked', false);
                                    window.location.reload()
                                }, 3000);
                            }
                        }
                    })
                } else {
                    return false;
                }
            }
        );
    });
}

//删除多条数据
function jumps(url) {
    if ($("[yang=yang]:checkbox:checked").length > 0) {
        $(document).ready(function () {
            swal({
                    title: "您确定要删除这条信息吗",
                    text: "删除后将无法恢复，请谨慎操作！",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是的，我要删除！",
                    cancelButtonText: "让我再考虑一下…",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var delete_id = [];
                        var i = 0;
                        $.each($("[yang=yang]:checkbox:checked"), function () {
                            if (this.checked) {
                                delete_id[i] = $(this).val();
                                i++;
                            }
                        });
                        var num = JSON.stringify((delete_id));
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                id: num
                            },
                            beforeSend: function () {
                                $('#ok').modal('show');
                            },
                            success: function (r, s, x) {
                                if (r == 'true') {
                                    $('#ok-img').attr('src', '../images/jump_success.png');
                                    $('#ok-text').html('数据交互成功');
                                    setTimeout(function () {
                                        $("[yang=yang]:checkbox:checked").attr('checked', false);
                                        window.location.reload()
                                    }, 100);
                                }
                            }
                        })
                    } else {
                        return false;
                    }
                }
            )
        });
    } else {
        $(document).ready(function () {
            swal({
                title: "警告",
                text: "至少有一个被选中！"
            });
        });
    }
}



