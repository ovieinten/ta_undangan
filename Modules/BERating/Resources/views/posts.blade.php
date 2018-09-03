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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
@stop

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themesale">Rating</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Rating</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Rating</h4>
                    <h6 class="card-subtitle">Berisikan Data Rating Produk</h6>
                    
                    <div class="table-responsive m-t-40">
                        <table id="table-layout" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                {{--<th>#</th>--}}
                                <th>Product Id</th>
	                            <th width="400px">Star</th>
                            </tr>

                            @if($posts->count())
	                            @foreach($posts as $post)
	                            <tr>
	                                <td>{{ $post->id }}</td>
	                                <td>
	                                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $post->rating }}" data-size="xs" disabled="">
	                                </td>
	                            </tr>
	                            @endforeach
                        	@endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
	<script type="text/javascript">
	    $("#input-id").rating();
	</script>
@stop
