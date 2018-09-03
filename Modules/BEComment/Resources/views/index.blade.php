@extends('backend.layout')

@section('style')
    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Custom box css -->
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">

@stop

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Plain Page</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <div class="button-list">
                    <a onclick="addForm()" class="btn btn-success waves-effect w-md mr-2 mb-2 btn-rounded" style="float: right;" >Tambah Komentar</a>
                </div>
            </div>
        </div><!-- end col -->
    </div>

    <div class="row fixed">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Default Example <small>Comments</small></h2>
                    <div class="clearfix"></div>
                </div>
                    <div class="x_content" style="width: 100%;">
                        <table id="table-layout" class="table table-striped table-bordered" cellspacing="0" width="100%" style="padding-right: 0px !important;">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>User</th>
                                <th>Produk</th>
                                <th>Komentar</th>
                                <th class="" style="text-align: center; width: 5%;"><span class="fa fa-ellipsis-v "></span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div> <!-- end row -->
    @include('becomment::_modal')
@stop

@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{asset('plugins/custombox/js/custombox.min.js')}}"></script>
    <script src="{{asset('plugins/custombox/js/legacy.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        //data table script

        var table = $('#table-layout').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('backend.comment.getdata') }}",
            columns: [
                {data: 'user.name', name: 'user.name'},
                {data: 'produk.name', name: 'produk.name'},
                {data: 'body', name: 'body'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('#modal-form').modal('show');
            $('#ps-form')[0].reset();
            $('.modal-title').text('Tambah Komentar');
        }

        function editForm(id) {
            save_method = 'edit';
            $('#ps-form')[0].reset();
            $.ajax({
                url: "{{ url('b/comment') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Komentar');
                    $('#id').val(data.id);
                    $('#product_id').val(data.product_id);
                    $('#percent').val(data.percent);
                    $('#date_start').val(data.date_start);
                    $('#date_end').val(data.date_end);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }

        function viewForm(id) {
            $.ajax({
                url: "{{ url('b/comment') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-detail').modal('show');
                    $('.modal-title').text('Lihat Detail Komentar');
                    $('#product_id').text(data.product_id);
                    $('#percent').text(data.percent);
                    $('#date_start').text(data.date_start);
                    $('#date_end').text(data.date_end);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }
        
        $(function () {
            $('#product_id').select2();
            $('#ps-form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    
                        if (save_method === "add") {
                            url = "{{url('b/comment/store')}}";
                            messages = "Ditambah";
                        }
                        else {
                            id = $('#id').val();
                            url = "{{ url('b/comment/update') }}/" + id;
                            messages = "Diubah";
                        }
                        table.ajax.reload();
                        Cooems.initSubmitAction(messages,url);
                        $("#parent_id").load("{{url('b/comment/select')}}");
                    return false;
                }
            });
        });

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/comment/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

    </script>
@stop