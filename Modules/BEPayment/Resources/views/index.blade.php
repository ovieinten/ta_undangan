@extends('backend.layout')

@section('style')
    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom box css -->
    <link href="{{asset('plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">

@stop

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Pembayaran</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Pembayaran</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="button-list">
                        <a href="{{ route('backend.payment.form') }}" class="btn btn-success waves-effect w-md mr-2 mb-2 btn-rounded" style="float: right;" >Tambah Pembayaran</a>
                    </div>
                    <h4 class="card-title">Data Pembayaran</h4>
                    <h6 class="card-subtitle">Berisikan Data Pembayaran</h6>                   
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Petugas</th>
                                <th>Order ID</th>
                                <th>Deskripsi</th>
                                <th>Bukti Transaksi</th>
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
            serverSide: true,
            ajax: "{{ route(@$data['route']) }}",
            columns: [
                {data: 'col_confirm_user_name', name: 'col_confirm_user_name'},
                {data: 'order.id', name: 'order.id'},
                {data: 'desc', name: 'desc'},
                {data: 'image_col', name: 'image_col'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/payment/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

    </script>
@stop
