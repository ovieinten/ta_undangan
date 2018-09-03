@extends('backend.layout')

@section('style')
    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom box css -->
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Produk</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Produk</h4>
                    <h6 class="card-subtitle">Berisikan Data Produk</h6>
                    
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Warna</th>
                                <th>Ukuran</th>
                                <th>Bentuk</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Rating</th>
                                <th class="" style="text-align: center; width: 5%;"><span class="fa fa-ellipsis-v "></span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
@stop

@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $("#input-id").rating();
    </script>

    <script>
        var table = $('#table-layout').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route(@$data['route']) }}",
            columns: [
                {data: 'product_name', name: 'product_name'},
                {data: 'product_price', name: 'product_price'},
                {data: 'product_desc', name: 'product_desc'},
                {data: 'category_name', name: 'category_name'},
                {data: 'color_name', name: 'color_name'},
                {data: 'size_name', name: 'size_name'},
                {data: 'shape_name', name: 'shape_name'},
                {data: 'status_col', name: 'status_col'},
                {data: 'product_note', name: 'product_note'},
                {data: 'col_rating', name: 'col_rating'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: [ [5, 'desc'] ]
        });

        function publishRow(id) {
            if (id) {
                var url =  "{{ url('b/product/publishing') }}/" + id;
                Cooems.initMyActionPublish('#table-layout',url);
            }
        }

        function draftRow(id){
            if(id) {
                var url =  "{{ url('b/product/draft') }}/" + id;
                Cooems.initMyActionDraft('#table-layout', url)
            }
        }

        function trashRow(id) {
            if (id) {
                var url =  "{{ url('b/product/trash') }}/" + id;
                Cooems.initMyActionTrash('#table-layout',url);
            }
        }

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/product/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

        function restoreRow(id){
            if (id) {
                var url =  "{{ url('b/product/restore') }}/" + id;
                Cooems.initMyActionRestore('#table-layout',url);
            }
        }

    </script>
@stop