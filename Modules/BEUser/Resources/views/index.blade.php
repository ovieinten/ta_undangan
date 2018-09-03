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
            <h4 class="text-themecolor">User</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="button-list">
                        <a href="{{ route('backend.user.form') }}" class="btn btn-success waves-effect w-md mr-2 mb-2 btn-rounded" style="float: right;" >Tambah User</a>
                    </div>
                    <h4 class="card-title">Data User</h4>
                    <h6 class="card-subtitle">Berisikan Data User</h6>                    
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
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
                {data: getFullName, name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role.full_name', name: 'role.full_name'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });

        function deleteRow(id){
            if (id) {
                var url =  "{{ url('b/user/delete') }}/" + id;
                Cooems.initMyActionDelete('#table-layout',url);
            }
        }

        function getFullName(data, type, dataToSet) {
            return data.first_name + " " + data.last_name;
        }
    </script>
@stop
