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
    <form action="{{ @$data['sale'] ? route('backend.sale.update', ['id' => @$data['sale']->id]) : route('backend.sale.store') }}" enctype="multipart/form-data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
      {{csrf_field()}}
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 50px;">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Order ID</label>
                            <div class="input-group">
                                <select required name="order" class="select-form-advance js-select2 form-control">
                                <option disabled selected value>Pilih Nomor Order</option>
                                @foreach(@$data['order'] as $item)
                                    <option value="{{@$item->id}}" {{old('order') == @$item->id ? "selected" : @$item->id == @$data['sale']->order_id ? 'selected' : null}}>{{@$item->id}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pembayaran</label>
                            <div class="input-group">
                                <select required name="payment" class="select-form-advance js-select2 form-control">
                                <option disabled selected value>Pilih Pembayaran</option>
                                @foreach(@$data['payment'] as $item)
                                    <option value="{{@$item->id}}" {{old('payment') == @$item->id ? "selected" : @$item->id == @$data['sale']->payment_id ? 'selected' : null}}>{{@$item->id}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Paid Total</label>
                            <input class="form-control" required type="text" id="name" name="paid_total" value="{{ @$data['sale']->paid_total }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 20px;">Simpan</button>
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