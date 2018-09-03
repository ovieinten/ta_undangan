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
            border: 1px solid;
            padding: 10px;
            box-shadow: 5px 10px #888888;
        }
    </style>
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
    <form action="{{ @$data['payment'] ? route('backend.payment.update', ['id' => @$data['payment']->id]) : route('backend.payment.store') }}" enctype="multipart/form-data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
      {{csrf_field()}}
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 50px;">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-xs-12" style="margin-left: 10px;">
                    <div class="form-group">
                        <label>User</label>
                        <div class="input-group">
                            <select required name="user" class="select-form-advance js-select2 form-control">
                            <option disabled selected value>Pilih User</option>
                            @foreach(@$data['user'] as $item)
                                <option value="{{@$item->id}}" {{old('user') == @$item->id ? "selected" : @$item->id == @$data['payment']->user_id ? 'selected' : null}}>{{@$item->first_name}} {{@$item->last_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                      <div class="form-group">
                          <label>Order</label>
                          <div class="input-group">
                              <select required name="order" class="select-form-advance js-select2 form-control">
                                  <option disabled selected value>Pilih Order</option>
                                  @foreach(@$data['order'] as $item)
                                      <option value="{{@$item->id}}" {{old('order') == @$item->id ? "selected" : @$item->id == @$data['payment']->order_id ? 'selected' : null}}>{{@$item->id}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea required id="desc" name="desc" style="width: 100%;">{{ @$data['payment']->desc }}</textarea>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12" style="float: right; margin-left: 70px;">
                  <br>
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->
                        <a id="fancPreview" href="" class="fancPreview">
                          <img class="img-responsive avatar-view" id="img_url" src="{{ @$data['payment'] ? url(@$data['payment']->image) :  asset('images/users/userdefault.png') }}" alt="Avatar" title="Change the avatar" style="height: 300px;">
                        </a>
                      </div> <br>
                      <input {{@$data['payment'] ?? 'required'}} name="file" id="imgInput" type="file" src="" alt=""
                                 class="filestyle" data-btnClass="btn-primary"
                                 accept="image/x-png,image/gif,image/jpeg,image/jpg">
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="float: right;">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
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