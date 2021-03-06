<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script>
<script>
    $(function () {
        $("#table").DataTable({
            responsive: true,
            autoWidth: false,
            paging: false,
            searching: false,
            info: false,
        });
    });

function deleteRecord(id) {
    swal({
        title: "سيتم حذف هذا الصف!",
        text: "هل انت متاكد؟",
        icon: "warning",
        buttons: {
            cancel: {
                text: "الغاء",
                value: null,
                visible: true
            },
            confirm: {
                text: "حذف",
                value: true,
                className: 'confirm-button'
            }
        },

    }).then(isConfirm => {
        if (isConfirm) {
            let url = $(`#delete-route-${id}`).prop('href');
            token = $('input[name="_token"]').val();
            let data = {
                _token: token
            }
            $.ajax({
                url: url,
                type: 'delete',
                data: data,
                success: function (response) {
                    if (response.status) {
                        swal("تم الحذف بنجاح!", "", "success");
                        $('#record-' + id).remove();
                    } else {
                        if (response.data.msg != undefined)
                            swal(response.data.msg, "", "error");
                        else
                            swal("الرجاء التواصل مع الدعم !", "", "error");
                    }

                }
            })

        }
    });
}

function banUser(id) {
    let title = '';
    let status = $(`#ban-${id}`).val();
    // console.log(status==1);
    if (status != 1) {
        title = "سيتم فك حظر هذا المستخدم";
    } else {
        title = "سيتم حظر هذا المستخدم"
    }
    swal({
        title: title,
        text: "هل انت متاكد؟",
        icon: "warning",
        buttons: {
            cancel: {
                text: "الغاء",
                value: null,
                visible: true
            },
            confirm: {
                text: "موافق",
                value: true,
                className: 'confirm-button'
            }
        },

    }).then(isConfirm => {
        if (isConfirm) {
            let url = $(`#update-route-${id}`).prop('href');
            token = $('input[name="_token"]').val();
            let data = {
                _token: token,
                ban: status
            }
            $.ajax({
                url: url,
                type: 'put',
                data: data,
                success: function (response) {
                    if (response.status) {
                        swal(response.data.msg, "", "success");
                        if (status != 1) {
                            $(`#ban-${id}`).val(1);
                            $(`#status-${id}`).html('غير محظور');
                        } else {
                            $(`#ban-${id}`).val(0);
                            $(`#status-${id}`).html('محظور');
                        }
                    } else {
                        if (response.data.msg != undefined)
                            swal(response.data.msg, "", "error");
                        else
                            swal("الرجاء التواصل مع الدعم !", "", "error");
                    }

                }
            })

        }
    });
}

    function updateAccountType(id) {
        let title = '';
        let status = $(`#change-${id}`).val();
        // console.log(status==1);
        if (status != 1) {
            title = "سيتم تحويل عضوية هذا المستخدم الى الفضية";
        } else {
            title = "سيتم تحويل عضوية هذا المستخدم الى الماسية";

        }
        swal({
            title: title,
            text: "هل انت متاكد؟",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "الغاء",
                    value: null,
                    visible: true
                },
                confirm: {
                    text: "موافق",
                    value: true,
                    className: 'confirm-button'
                }
            },

        }).then(isConfirm => {
            if (isConfirm) {
                let url = $(`#update-route-${id}`).prop('href');
                token = $('input[name="_token"]').val();
                let data = {
                    _token: token,
                    account: status
                }
                $.ajax({
                    url: url,
                    type: 'put',
                    data: data,
                    success: function (response) {
                        if (response.status) {
                            swal(response.data.msg, "", "success");
                            let arrow = document.getElementById(`arrow-${id}`);
                            if (status != 1) {
                                $(`#change-${id}`).val(1);
                                $(`#account-${id}`).html('عضوية فضية');
                                arrow.classList.remove('fa-arrow-down');
                                arrow.classList.add('fa-arrow-up');
                            } else {
                                $(`#change-${id}`).val(0);
                                $(`#account-${id}`).html('عضوية الماسية');
                                arrow.classList.remove('fa-arrow-up');
                                arrow.classList.add('fa-arrow-down');

                            }
                        } else {
                            if (response.data.msg != undefined)
                                swal(response.data.msg, "", "error");
                            else
                                swal("الرجاء التواصل مع الدعم !", "", "error");
                        }

                    }
                })

            }
        });
    }
    function isBest(id) {
        let title = '';
        let status = $(`#best-${id}`).val();
        // console.log(status==1);
        if (status != 1) {
            title = "هل تريد ازالة هذا المكان من قائمة افضل الاماكن";
        } else {
            title = "هل تريد وضع هذا المكان في قائمة افضل الاماكن";

        }
        swal({
            title: title,
            text: "هل انت متاكد؟",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "الغاء",
                    value: null,
                    visible: true
                },
                confirm: {
                    text: "موافق",
                    value: true,
                    className: 'confirm-button'
                }
            },

        }).then(isConfirm => {
            if (isConfirm) {
                let url = $(`#update-route-${id}`).prop('href');
                token = $('input[name="_token"]').val();
                let data = {
                    _token: token,
                    best: status
                }
                $.ajax({
                    url: url,
                    type: 'put',
                    data: data,
                    success: function (response) {
                        if (response.status) {
                            swal(response.data.msg, "", "success");
                            let favourite = document.getElementById(`favourite-${id}`);
                            if (status != 1) {
                                $(`#best-${id}`).val(1);
                                $(`#is-best-${id}`).html('لا');
                                favourite.classList.remove('fas');
                                favourite.classList.add('far');
                            } else {
                                $(`#best-${id}`).val(0);
                                $(`#is-best-${id}`).html('نعم');
                                favourite.classList.remove('far');
                                favourite.classList.add('fas');

                            }
                        } else {
                            if (response.data.msg != undefined)
                                swal(response.data.msg, "", "error");
                            else
                                swal("الرجاء التواصل مع الدعم !", "", "error");
                        }

                    }
                })

            }
        });
    }
</script>
