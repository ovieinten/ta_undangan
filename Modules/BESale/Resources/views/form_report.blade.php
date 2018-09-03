@extends('backend.layout')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css"
          type="text/css">
    <style>
        .fancybox-image, .fancybox-spaceball {
            height: unset !important;
            width: unset !important;
            max-width: 900px;
            max-height: 700px;
        }

        .img-responsive {
            bsale: 1px solid;
            padding: 10px;
            box-shadow: 5px 10px #888888;
        }
    </style>
@stop

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Penjualan</h4>
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
    <form action="{{ route('backend.sale.report') }}" enctype="multipart/form-data" method="get" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 50px;">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-12">
                        <div class="form-group" id="selectBulan">
                            <label>Tahun</label>
                            <select class="form-control" name="filter_tahun_select">
                                <option value=""></option>
                                @for($i=2010; $i<=2050; $i++)
                                <option value="{{$i}}">{{@$i}}</option>
                                @endfor
                            </select>     
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="selectBulan">
                            <label>Bulan</label>
                            <select class="form-control" name="filter_bulan_select">
                                <option value=""></option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>     
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 20px;">Lihat Laporan</button>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"
            type="text/javascript"></script>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_url').attr('src', e.target.result);
                $('#fancPreview').attr('href', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInput").change(function () {
        readURL(this);
    });
</script>

<script>
    $(".fancPreview")
        .attr('rel', 'gallery')
        .fancybox({
            padding: 0,
            afterShow: function () {
                $('.fancybox-button--zoom').click();
            }
        });
</script>
@stop