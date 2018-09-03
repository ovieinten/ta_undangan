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
            <h4 class="text-themecolor">Pemesanan</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Pemesanan</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pemesanan</h4>
                    <h6 class="card-subtitle">Berisikan Data Pemesanan Produk</h6>

                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Order ID</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Product</th>
                                <th>Nomor HP</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th>Kab/Kota</th>
                                <th>Kode Pos</th>
                                <th>Harga Total</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Catatan</th>
                                <th>Status</th>
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
        var table = $('#table-layout').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route(@$data['route']) }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: getFullName, name: 'name'},
                {data: 'product.name', name: 'product.name'},
                {data: 'number', name: 'number'},
                {data: 'address', name: 'address'},
                {data: 'district', name: 'disctrict'},
                {data: 'regence', name: 'regence'},
                {data: 'post_code', name: 'post_code'},
                {data: 'grand_total', name: 'grand_total'},
                {data: 'date', name: 'date'},
                {data: 'desc', name: 'desc'},
                {data: 'status_col', name: 'status_col'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: [ [5, 'desc'] ]
        });

        function getFullName(data, type, dataToSet) {
            return data.user.first_name + " " + data.user.last_name;
        }

        function confirmRow(id){
            if(id) {
                var url =  "{{ url('b/order/confirm') }}/" + id;
                Cooems.initMyActionConfirm('#table-layout', url)
            }
        }

        function packageRow(id) {
            if (id) {
                var url =  "{{ url('b/order/packaging') }}/" + id;
                Cooems.initMyActionPackaging('#table-layout',url);
            }
        }

        function shippedoutRow(id) {
            if (id) {
                var url =  "{{ url('b/order/shippingOut') }}/" + id;
                Cooems.initMyActionShippedOut('#table-layout',url);
            }
        }

        function deliveredRow(id) {
            if (id) {
                var url =  "{{ url('b/order/deliver') }}/" + id;
                Cooems.initMyActionShippedOut('#table-layout',url);
            }
        }

        function trashRow(id) {
            if (id) {
                var url =  "{{ url('b/order/trash') }}/" + id;
                Cooems.initMyActionCancel('#table-layout',url);
            }
        }

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/order/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }
    </script>
@stop