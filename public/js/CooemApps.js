var Coems = function() {

    var handleblockUI = function() {
        // Codebase.loader('show');
        $("#loading").slideDown("slow");
        // setTimeout(function () {
        //     Codebase.loader('hide');
        // }, 2000);
        // Pace.restart();
    };

    var handleunBlockUI = function() {
        // Codebase.loader('hide');
        $("#loading").slideUp("slow");
    };

    var handleNotify = function(type, message, icon){
        // $.notify({
        //     icon    : 'fa fa-'+icon,
        //     message : message
        // },{
        //     type: type
        // });
    };

    var handleMyFileUploads = function(Images, items)
    {
        var url = Images.attr('upload-url');
        var file = Images.prop('files')[0];
        var form_image = new FormData();
        form_image.append('images', file);
        form_image.append('record_id', items);

        $.ajax({
            url: url, // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_image,
            success: function(data){
                if (data.status) {
                    // $.notify({
                    //     icon    : 'fa fa-check',
                    //     message : 'Data berhasil Ditambah!'
                    // },{
                    //     type: 'success'
                    // });
                }
            }
        });
    }

    /*
     * Select2, for more examples you can check out https://github.com/select2/select2
     *
     * Codebase.helper('select2');
     *
     */

    /* formInput */

    var handlemFormValidation = function(form_target, message, rules, upload)
    {
        var form_input      = $(form_target);
        var form_data       = $(form_target).serializeArray();
        var form_mode       = form_input.attr('form-mode');
        var form_action     = form_input.attr('action');
        var form_confirm    = form_input.attr('data-confirm');
        var form_title      = form_input.attr('data-title') || 'Proses Data';
        var form_message    = form_input.attr('data-message') || 'mohon periksa kembali inputan anda, lanjutkan proses?';
        var mybtn           = $('.my-btn-action');
        var _token          = $('meta[name = csrf-token]').attr('content');

        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-alt-success m-5',
            cancelButtonClass: 'btn btn-lg btn-alt-danger m-5',
            inputClass: 'form-control'
        });

        if (form_mode == "add"){
            var FormData = {form_data,'_token' : _token};
        }else{
            var FormData = {'_method':'put' , form_data ,'_token' : _token};

        }

        mybtn.attr('data-loading-text', "<i class='fa fa-circle-o-notch fa-spin'></i> Processing");
        form_input.validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },

            rules:rules,
            // message:message,

            submitHandler: function(form) {
                if ( form_confirm == 1 ) {
                    swal({
                        title   : form_title,
                        text    : form_message,
                        type    : "question",
                        showCancelButton    : true,
                        cancelButtonText    : "Batal",
                        confirmButtonColor  : '#d26a5c',
                        confirmButtonText   : 'Ya !',
                        html: false,
                        preConfirm: function() {
                            return new Promise(function (resolve) {
                                setTimeout(function () {
                                    resolve();
                                }, 50);
                            });
                        }
                    }).then(function (result) {
                            Coems.blockUI();
                            $.ajax({
                                url : form_action,
                                type : "post",
                                data : FormData,
                                success : function(data) {
                                    console.log(data);
                                    if (data.status) {
                                        if (upload) {
                                            var record_id = data.data.last_id;
                                            Coems.uploadfile(upload, record_id);
                                            callback_form(data);
                                        }else{
                                            // Coems.handleNotify();
                                            // $.notify({
                                            //     icon    : 'fa fa-check',
                                            //     message : 'Data berhasil di tambah'
                                            // },{
                                            //     type: 'success'
                                            // });
                                            callback_form(data);
                                        }
                                    }else{
                                        callback_error();
                                    }
                                },
                                error : function(err){
                                    callback_error();
                                }
                            });
                        },
                        // result.dismiss can be 'cancel', 'overlay',
                        function(dismiss){
                            mybtn.button('reset');
                        });
                } else {
                    Coems.blockUI();
                    // var options = {
                    //     dataType:      'json',
                    //     success:       callback_form,
                    //     error:         callback_error
                    // };
                    // form_input.ajaxSubmit(options);
                }

            }
        });


        function action_redirect_form(res, $form)
        {
            if ( res.redirect != undefined || $('.my-btn-redirect').length ) {
                var redirect    = res.redirect || $('.my-btn-redirect').attr('href');
                $('.my-btn-redirect').attr('href', redirect);
                $('.my-btn-redirect')[0].click();
                return true;
            }
        }

        function callback_form(res, statusText, xhr, $form){
            swal.setDefaults({
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-alt-success m-5',
                cancelButtonClass: 'btn btn-lg btn-alt-danger m-5',
                inputClass: 'form-control'
            });

            Coems.unblockUI();
            if ( res.status ) {
                if ( form_confirm == 1 ) {
                    if (true) {};
                    swal({
                        title   : 'Sukses',
                        text    : 'Data Tersimpan',
                        type    : "success",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        confirmButtonClass: 'btn btn-info',
                        buttonsStyling: false,
                        animation: false,
                        html: false,
                        preConfirm: function() {
                            return new Promise(function (resolve) {
                                setTimeout(function () {
                                    resolve();
                                }, 50);
                            });
                        }
                    }).then(function (result) {
                        // $.notify({
                        //     icon    : 'fa fa-check',
                        //     message : 'Data berhasil Ditambah!'
                        // },{
                        //     type: 'success'
                        // });

                        if (typeof callback == "function") {
                            callback(res);
                        }else{
                            action_redirect_form(res, $form);
                        };
                    });
                } else {
                    action_redirect_form(res, $form);
                }
            } else {
                var i = $("#ps-form-message");
                var errorMsg = 'your data is <strong>not valid</strong>, please double check and try again!<br>';
                i.find('.m-alert__text').first().html(errorMsg);
                i.slideDown('slow');
            }
            mybtn.button('reset');
        }

        function callback_error(){

            swal("error!", "server tidak dapat memproses data anda, silahkan periksa kembali!", "warning");
            Coems.unblockUI();
            mybtn.button('reset');
        }

        Coems.initmSelect2();

    };

    /* initialisasi handle select2 */

    var initSelect2 = function(){
        function formatRepo (repo) {
            if (repo.loading) return repo.text;

            if ( repo.showDesc == true && ( repo.desc != null && repo.desc != "" && repo.desc != undefined ) )
            {
                var markup = '' +
                    '<div class="clearfix">' +
                    '<div class="col-md-6">' + repo.text + '</div>' +
                    '<div class="col-md-6">' + repo.desc + '</div>'
                '</div>' +
                '';
            }
            else
            {
                var markup = '' +
                    '<div class="clearfix">' +
                    '<div class="col-md-12">' + repo.text + '</div>' +
                    '</div>' +
                    '';
            }

            return markup;
        }

        function formatRepoSelection (repo) {
            return repo.text;
        }

        $(".select-form-advance").each(function(){
            var url = $(this).data('url');
            $(this).select2({
                placeholder: "Search for git repositories",
                allowClear: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            // '_method' : 'get',
                            // '_token' : $('meta[name = csrf-token]').attr('content'), // search term
                            q: params.term, // search term
                            page: params.page,
                            showDesc: false
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        });
    }

    /* initialisasi datatable yajra */
    var handleDataTable = function(table, columnsTable) {

        var initTable = $(table);
        var TableUrl = $(table).attr('table-url');

        var exDataTable = function() {
            jQuery.extend( jQuery.fn.dataTable.ext.classes, {
                sWrapper: "dataTables_wrapper dt-bootstrap4"
            });
        };

        var initDataTableFull = function() {
            var t = $(initTable).dataTable({
                pageLength  : 10,
                responsive  : true,
                processing  : true,
                serverSide  : true,
                lengthMenu  : [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                autoWidth   : false,
                ajax        : {
                    url : TableUrl
                },
                columns:columnsTable
            });
        };


        $(".datatable_check_all").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
            var l = $('input:checkbox:checked').length;
            if (l > 0) {
                $("#m_datatable_selected_number").html(parseInt(l) - 1), l > 0 && $("#m_datatable_group_action_form").collapse("show");
            }else{
                $("#m_datatable_selected_number").html(parseInt(l)), 0 === l && $("#m_datatable_group_action_form").collapse("hide");
            }
        });

        if ($("#datatable_check_all").length ) {
            $("#datatable_check_all").on("click", function(){
                var ids     = [];
                var val = [];

                $('input:checkbox:checked').each(function () {
                    if (!jQuery.isEmptyObject(this.value) && this.value != 'on') {
                        ids.push(this.value);
                    }
                });
                console.log(ids);
                if ( ids.length ) {
                    // do ajax here
                    var url = $(this).attr('psdata-url');

                    swal({
                        title   : "Apakah anda yakin?",
                        text    : "Setelah dihapus, data tidak akan bisa dikembalikan!",
                        type    : "warning",
                        showCancelButton    : true,
                        cancelButtonText    : "Batal",
                        confirmButtonColor  : '#d26a5c',
                        confirmButtonText   : 'Ya, hapus!',
                        html: false,
                        preConfirm: function() {
                            return new Promise(function (resolve) {
                                setTimeout(function () {
                                    resolve();
                                }, 50);
                            });
                        }
                    }).then(
                        function (result) {
                            Coems.blockUI();
                            $.ajax({
                                url: url,
                                type: 'POST',
                                dataType: 'JSON',
                                data: {id: ids,'_token':$('meta[name = csrf-token]').attr('content')},
                                success : function(data){
                                    if (data.status) {
                                        var _title  = (data.status) ? 'Success!' : 'Error!';
                                        var _status  = (data.status) ? 'success' : 'error!';

                                        // $.notify({
                                        //     icon    : 'fa fa-check',
                                        //     message : 'Data berhasil Dihapus!'
                                        // },{
                                        //     type: 'success'
                                        // });
                                        location.reload();
                                        Coems.unblockUI();
                                        // $(initTable).DataTable().ajax.reload();
                                    }else{
                                        // $.notify({
                                        //     icon    : 'fa fa-check',
                                        //     message : 'Data Gagal Dihapus!'
                                        // },{
                                        //     type: 'error'
                                        // });
                                    }
                                },error : function(){
                                    $.notify({
                                        icon    : 'fa fa-check',
                                        message : 'Data Gagal Dihapus!'
                                    },{
                                        type: 'error'
                                    });
                                }
                            });
                        }, function(dismiss) {

                        }
                    );
                }
            });
        }

        exDataTable();
        initDataTableFull();
    };


    /* Preview Image */

    /* checkall */

    var initMyActionDelete = function(form, url)
    {
        var form_input = $(form);
        /* Act on the event */
        /* my-swal format */
        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-alt-success m-5',
            cancelButtonClass: 'btn btn-lg btn-alt-danger m-5',
            inputClass: 'form-control'
        });

        function _delete() {
            swal({
                title   : "Apakah anda yakin?",
                text    : "Setelah dihapus, data tidak akan bisa dikembalikan!",
                type    : "warning",
                showCancelButton    : true,
                cancelButtonText    : "Batal",
                confirmButtonColor  : '#d26a5c',
                confirmButtonText   : 'Ya, hapus!',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(
                function (result) {
                    Coems.blockUI();
                    $.ajax({
                        url : url,
                        type : "post",
                        data : {'_method' : 'delete', '_token' : $('meta[name = csrf-token]').attr('content')},
                        success : function(data) {
                            if(data.status){
                                location.reload();
                                Coems.unblockUI();
                                // $.notify({
                                //     icon    : 'fa fa-check',
                                //     message : 'Data berhasil dihapus!'
                                // },{
                                //     type: 'success'
                                // });
                            }else{
                                // $.notify({
                                //     icon    : 'fa fa-close',
                                //     message : 'Data Gagal dihapus!'
                                // },{
                                //     type: 'error'
                                // });
                            }
                        },
                        error : function(err){

                        }
                    });
                }, function(dismiss) {

                }
            );
        }

        if (url){
            _delete();
        }else{
            Coems.initMybulk();
        }
    };

    var myActionBulk = function () {
        function _bulk() {
            var l = $('input:checkbox:checked').length;
            if (l > 0) {
                $("#m_datatable_selected_number").html(parseInt(l)), l > 0 && $("#m_datatable_group_action_form").collapse("show");
            }else{
                $("#m_datatable_selected_number").html(parseInt(l)), 0 === l && $("#m_datatable_group_action_form").collapse("hide");
            }
        }

        _bulk();
    };

    var myPicutre = function (img, chooseFile) {
        var imgPreview  = $(img);
        var filePreview = $(chooseFile);

        $(imgPreview).on('change', function(){
            readImage(this);
        });

        function readImage(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(filePreview).attr('src', e.target.result);
                    // $("#av1").attr('href', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    };

    var initErrorAction = function (action) {
        swal({
                buttonsStyling: false,
                title: 'Error !',
                text: "Data Gagal "+action,
                type: 'error',
                confirmButtonClass: 'btn btn-lg btn-rounded btn-danger'
            }
        )
    };
    return {

        initmFormValidation : function(form_target, message, rules, isupload)
        {
            handlemFormValidation(form_target, message, rules, isupload);
        },

        initmSelect2 : function(){
            initSelect2();
        },

        blockUI : function() {
            handleblockUI();
        },

        unblockUI : function() {
            handleunBlockUI();
        },

        notify : function(type, message, title) {
            handleToastr(type, message, title);
        },

        uploadfile : function(images, items){
            handleMyFileUploads(images, items);
        },

        initDataTable : function(table, columnsTable){
            handleDataTable(table, columnsTable);
        },

        previewImage : function(image){
            handlePreviewImage(image);
        },

        initMyAction : function(form, url)
        {
            initMyActionDelete(form, url);
        },

        initMybulk : function () {
            myActionBulk();
        },

        initPreviewImage : function (img, chooseFile) {
            myPicutre(img, chooseFile);
        },
        initErrorAction : function (action) {
            initErrorAction(action);
        }

    }
}();