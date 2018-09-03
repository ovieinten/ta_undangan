@extends('backend.layout')

@section('style')
    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom box css -->
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Karya</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Karya</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Karya</h4>
                    <h6 class="card-subtitle">Berisikan Data Karya</h6>

                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Warna</th>
                                <th>Ukuran</th>
                                <th>Bentuk</th>
                                <th>Status</th>
                                <th>Konfirmasi</th>
                                <th class="" style="text-align: center; width: 5%;"><span class="fa fa-ellipsis-v "></span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
    @include('becreation::_modal')
@stop

@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var table = $('#table-layout').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route(@$data['route']) }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'desc', name: 'desc'},
                {data: 'color.name', name: 'color.name'},
                {data: 'size.name', name: 'size.name'},
                {data: 'shape.name', name: 'shape.name'},
                {data: 'status_col', name: 'status_col'},
                {data: 'confirm', name: 'confirm'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: [ [5, 'desc'] ]
        });

        function confirm(id) {
            save_method = "add";
            $('#modal-form').modal('show');
            $('#ps-form')[0].reset();
            $('.modal-title').text('Konfirmasi Karya');
        }

        function sendRow(id) {
            if (id) {
                var url =  "{{ url('b/creation/sending') }}/" + id;
                Cooems.initMyActionPublish('#table-layout',url);
            }
        }

        function acceptRow(id){
            if(id) {
                var url =  "{{ url('b/creation/accept') }}/" + id;
                Cooems.initMyActionDraft('#table-layout', url)
            }
        }

        function trashRow(id) {
            if (id) {
                var url =  "{{ url('b/creation/trash') }}/" + id;
                Cooems.initMyActionTrash('#table-layout',url);
            }
        }

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/creation/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

        function restoreRow(id){
            if (id) {
                var url =  "{{ url('b/creation/restore') }}/" + id;
                Cooems.initMyActionRestore('#table-layout',url);
            }
        }
        $(function () {
            $('#parent_id').select2();
            $('#ps-form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {

                    if (save_method === "add") {
                        url = "{{url('b/creation/store')}}";
                        messages = "Ditambah";
                    }
                    else {
                        id = $('#id').val();
                        url = "{{ url('b/creation/update') }}/" + id;
                        messages = "Diubah";
                    }
                    table.ajax.reload();
                    Cooems.initSubmitAction(messages,url);
                    $("#parent_id").load("{{url('b/creation/select')}}");
                    return false;
                }
            });
        });
        
        function viewCreation(id) {
            console.log(id);
            $.ajax({
                url: "{{ url('b/creation/getslug') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (res) {
                    console.log(res.data.slug);
                    var win = window.open(res.data.slug, '_blank');
                    if (win) {
                        win.focus();
                    } else {
                        alert('Please allow popups for this website');
                    }
                },
                error: function (e) {
                    console.log(e);
                    alert("Nothing Data");
                }
            });
        }

    </script>
@stop