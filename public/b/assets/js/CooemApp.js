$(document).ready(function () {
    $("#loading").slideUp("slow");

});

$(document).ajaxStart(function (event, jqxhr, settings) {
    $("#loading").slideDown("slow");
});

$(document).ajaxComplete(function () {
    $("#loading").slideUp("slow");
});

var Cooems = function () {
    var initSubmitAction = function (messages, url) {
        $.ajax({
            url: url,
            type: "POST",
            data: $('#ps-form').serialize(),
            success: function (data) {
                $('#modal-form').modal('hide');
                table.ajax.reload();
                Cooems.initSuccessAction(messages)
            },
            error: function (data) {
                Cooems.initErrorAction(messages);
            }
        });
        return false;
    };

    var initSuccessAction = function (action) {
        swal({
                buttonsStyling: false,
                title: 'Sukses !',
                text: "Data Berhasil " + action,
                type: 'success',
                confirmButtonColor: '#d26a5c',
                confirmButtonClass: 'btn btn-lg btn-rounded btn-success'
            }
        )
    };
    var initErrorAction = function (action) {
        swal({
                buttonsStyling: false,
                title: 'Error !',
                text: "Data Gagal " + action,
                type: 'error',
                confirmButtonClass: 'btn btn-lg btn-rounded btn-danger'
            }
        )
    };
    var initMyActionDelete = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _delete() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah dihapus, data tidak akan bisa dikembalikan!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, hapus!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {'_method': 'delete', '_token': $('meta[name = csrf-token]').attr('content')},
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Dihapus')

                        },
                        error: function (err) {
                            Cooems.initErrorAction('Dihapus')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _delete();
        }
    };

    var initMyActionTrash = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _trash() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah data tidak akan tampil di halaman depan website, silahkan masuk ke menu Trash untuk melihat produk yang di sudah di hapus!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Pindahkan!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {'_method': 'delete', '_token': $('meta[name = csrf-token]').attr('content')},
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Trashed')

                        },
                        error: function (err) {
                            Cooems.initErrorAction('Trashed')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _trash();
        }
    };

    var initMyActionCancel = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _trash() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah data dipindahkan, silahkan masuk ke menu Cancel untuk melihat produk yang sudah di cancel!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Pindahkan!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {'_method': 'delete', '_token': $('meta[name = csrf-token]').attr('content')},
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Cancel')

                        },
                        error: function (err) {
                            Cooems.initErrorAction('Cancel')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _trash();
        }
    };

    var initMyActionConfirm = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di bayar sesuai kesepakatan, maka produk akan mulai dikerjakan!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Confirm!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('COnfirmed')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Confirmed')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };

    var initMyActionPackaging = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di package, maka pesanan akan siap dikirim ke tujuan!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Package!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Packaging')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Packaging')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };

    var initMyActionShippedOut = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di kirim, maka pemesan harus melunasi sisa biaya (jika ada sisa)!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, ShippedOut!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('ShippedOut')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('ShippedOut')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };

    var initMyActionDelivered = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk sampai pada tujuan, maka pemesana tersebut masuk ke dalam data penjualan!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Delivered!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Delivered')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Delivered')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };


    var initMyActionPublish = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di publish, maka akan tampil di halaman depan website!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Publish!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Published')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Published')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };

    var initMyActionPublish = function (form, url) {

        var form_input = $(form);

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _publishing() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di publish, maka akan tampil di halaman depan website!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Publish!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Published')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Published')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }



        if (url) {
            _publishing();
        }
    };

    var initMyActionRestore = function (form, url) {
        var form_input = $(form);
        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _restore() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di publish, maka akan tampil di halaman depan website!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Publish!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Published')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Published')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }


        if (url) {
            _restore();
        }
    };

    var initMyActionDraft = function (form, url) {
        var form_input = $(form);
        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-success btn-rounded waves-light waves-effect m-2',
            cancelButtonClass: 'btn btn-lg btn-danger btn-rounded waves-light waves-effect m-2',
            inputClass: 'btn-list'
        });

        function _draft() {
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah produk di draft, maka produk tidak akan tampil di halaman depan website!",
                type: "warning",

                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Ya, Draft!',
                html: false,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': $('meta[name = csrf-token]').attr('content')
                        },
                        success: function (data) {
                            $(form_input).DataTable().ajax.reload();
                            Cooems.initSuccessAction('Drafted')
                        },
                        error: function (err) {
                            Cooems.initErrorAction('Drafted')
                        }
                    });
                }, function (dismiss) {

                }
            );
        }


        if (url) {
            _draft();
        }
    };

    return {

        initSubmitAction: function (form, url) {
            initSubmitAction(form, url);
        },
        initMyActionDelete: function (form, url) {
            initMyActionDelete(form, url);
        },
        initMyActionTrash: function (form, url) {
            initMyActionTrash(form, url);
        },
        initMyActionCancel: function (form, url) {
            initMyActionCancel(form, url);
        },
        initMyActionConfirm: function (form, url) {
            initMyActionConfirm(form, url);
        },
        initMyActionPackaging: function (form, url) {
            initMyActionPackaging(form, url);
        },
        initMyActionShippedOut: function (form, url) {
            initMyActionShippedOut(form, url);
        },
        initMyActionDelivered: function (form, url) {
            initMyActionDelivered(form, url);
        },
        initMyActionRestore: function (form, url) {
            initMyActionRestore(form, url);
        },
        initMyActionPublish: function (form, url) {
            initMyActionPublish(form, url);
        },
        initMyActionDraft: function (form, url) {
            initMyActionDraft(form, url);
        },
        initSuccessAction: function (action) {
            initSuccessAction(action);
        },
        initErrorAction: function (action) {
            initErrorAction(action);
        }
    }
}();