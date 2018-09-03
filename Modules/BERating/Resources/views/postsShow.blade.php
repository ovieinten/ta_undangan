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

        <div class="col-md-12">

            <div class="panel panel-default">



                <div class="panel-body">

                    <form action="{{ route('posts.post') }}" method="POST">

                        {{ csrf_field() }}

                    <div class="card">

                        <div class="container-fliud">

                            <div class="wrapper row">

                                <div class="preview col-md-6">

                                    

                                    <div class="preview-pic tab-content">

                                      <div class="tab-pane active" id="pic-1"><img src="https://dummyimage.com/500x450/000/fff" /></div>

                                    </div>



                                </div>

                                <div class="details col-md-6">

                                    <h3 class="product-title">Laravel 5.5 Ratting System</h3>

                                    <div class="rating">

                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->userAverageRating }}" data-size="xs">

                                        <input type="hidden" name="id" required="" value="{{ $post->id }}">

                                        <span class="review-no">422 reviews</span>

                                        <br/>

                                        <button class="btn btn-success">Submit Review</button>

                                    </div>

                                    <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>

                                    <h4 class="price">current price: <span>$180</span></h4>

                                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>

                                    <h5 class="sizes">sizes:

                                        <span class="size" data-toggle="tooltip" title="small">s</span>

                                        <span class="size" data-toggle="tooltip" title="medium">m</span>

                                        <span class="size" data-toggle="tooltip" title="large">l</span>

                                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>

                                    </h5>

                                    <h5 class="colors">colors:

                                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>

                                        <span class="color green"></span>

                                        <span class="color blue"></span>

                                    </h5>

                                    <div class="action">

                                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>

                                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    </form>



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
