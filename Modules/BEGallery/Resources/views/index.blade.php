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
            <h4 class="text-themesale">Gallery</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row el-element-overlay">
        <div class="col-md-12">
            <h4 class="card-title">Gallery page</h4>
            <h6 class="card-subtitle m-b-20 text-muted">photos of all products</h6></div>
        @foreach($data as $photos)
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1"> <img src="{{asset( $photos->url) }}" alt="foto produk" />
                        <div class="el-overlay">
                            <ul class="el-info">
                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{asset( $photos->url) }}"><i class="icon-magnifier"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">{{@$photos->product->name}}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop
