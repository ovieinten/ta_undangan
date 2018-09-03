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
            <h4 class="text-themesale">Penjualan</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Penjualan</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="button-list">
                        <a href="{{ route('backend.sale.form') }}" class="btn btn-success waves-effect w-md mr-2 mb-2 btn-rounded" style="float: right;" >Tambah Penjualan</a>
                    </div>
                    <h4 class="card-title">Data Penjualan</h4>
                    <h6 class="card-subtitle">Berisikan Data Penjualan Produk</h6>
                    
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Order Number</th>
                                <th>Pembayaran ID</th>
                                <th>Total Pembayaran</th>
                                <th class="" style="text-align: center; width: 5%;"><span class="fa fa-ellipsis-v "></span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
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
    <script>
        var table = $('#table-layout').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('backend.sale.getdata') }}",
            columns: [
                {data: 'order.order_number', name: 'order.order_number'},
                {data: 'payment.id', name: 'payment.id'},
                {data: 'paid_total', name: 'paid_total'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('#modal-form').modal('show');
            $('#ps-form')[0].reset();
            $('.modal-title').text('Tambah Penjualan');
        }

        function editForm(id) {
            save_method = 'edit';
            $('#ps-form')[0].reset();
            $.ajax({
                url: "{{ url('b/sale') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Penjualan');
                    $('#id').val(data.id);
                    $('#order').val(data.order_id);
                    $('#payment').val(data.payment_id);
                    $('#paid_total').val(data.paid_total);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }

        function viewForm(id) {
            $.ajax({
                url: "{{ url('b/sale') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-detail').modal('show');
                    $('.modal-title').text('Lihat Detail Penjualan');
                    $('#d_order').text(data.order_id);
                    $('#d_payment').text(data.payment_id);
                    $('#d_paidTotal').text(data.paid_total);
                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/sale/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

    </script>
@stop
