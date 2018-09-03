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

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Kategori</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="button-list">
                        <a onclick="addForm()" class="btn btn-success waves-effect w-md mr-2 mb-2 btn-rounded" style="float: right;" >Tambah Kategori</a>
                    </div>
                    <h4 class="card-title">Data Kategori</h4>
                    <h6 class="card-subtitle">Berisikan Data Kategori Produk</h6>
                    
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                {{--<th>#</th>--}}
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th class="" style="text-align: center; width: 5%;"><span class="fa fa-ellipsis-v "></span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @include('becategory::_modal')
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
            ajax: "{{ route('backend.category.getdata') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'desc', name: 'desc'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('#modal-form').modal('show');
            $('#ps-form')[0].reset();
            $('.modal-title').text('Tambah Kategori');
        }

        function editForm(id) {
            save_method = 'edit';
            $('#ps-form')[0].reset();
            $.ajax({
                url: "{{ url('b/category') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Kategori');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#desc').val(data.desc);
                    // $('#cover').val(data.cover);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }

        function viewForm(id) {
            $.ajax({
                url: "{{ url('b/category') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-detail').modal('show');
                    $('.modal-title').text('Lihat Detail Kategori');
                    $('#d_name').text(data.name);
                    $('#d_desc').text(data.desc);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }
        $(function () {
            $('#ps-form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    
                        if (save_method === "add") {
                            url = "{{url('b/category/store')}}";
                            messages = "Ditambah";
                        }
                        else {
                            id = $('#id').val();
                            url = "{{ url('b/category/update') }}/" + id;
                            messages = "Diubah";
                        }
                        table.ajax.reload();
                        Cooems.initSubmitAction(messages,url);
                    return false;
                }
            });
        });

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/category/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }
    </script>
@stop