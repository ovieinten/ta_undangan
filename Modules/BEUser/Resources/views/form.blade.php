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
    <form action="{{ @$data['user'] ? route('backend.user.update', ['id' => @$data['user']->id]) : route('backend.user.store') }}" enctype="multipart/form-data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
      {{csrf_field()}}
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 50px;">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="form-group" {{ $errors->has('first_name') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                      </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" id="first-name" name="first_name" required="required" value="{{ @$data['user']->first_name }}" class="form-control">
                      </div>
                        @if ($errors->has('first_name'))
                              <span class="help-block">
                                   <strong style="color:red">{{ $errors->first('first_name') }}</strong>
                              </span>
                        @endif
                    </div>
                    <div class="form-group" {{ $errors->has('last_name') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name 
                      </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" id="last-name" name="last_name" value="{{ @$data['user']->last_name }}" class="form-control">
                      </div>
                        @if ($errors->has('last_name'))
                              <span class="help-block">
                                   <strong style="color:red">{{ $errors->first('last_name') }}</strong>
                              </span>
                        @endif
                    </div>
                    <div class="form-group" {{ $errors->has('email') ? ' has-error' : '' }}>
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="middle-name" class="form-control" type="text" name="email" value="{{ @$data['user']->email }}">
                      </div>
                    </div>
                    <div class="form-group" {{ $errors->has('password') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="password" class="form-control" name="password" >
                      </div>
                        @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong style="color:red">{{ $errors->first('password') }}</strong>
                              </span>
                        @endif
                    </div>
                    <div class="form-group" {{ $errors->has('pass_confirm') ? ' has-error' : '' }}>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12">Confirm Password <span class="required">*</span></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="password" class="form-control" name="pass_confirm">
                      </div>
                        @if ($errors->has('pass_confirm'))
                              <span class="help-block">
                                  <strong style="color:red">{{ $errors->first('pass_confirm') }}</strong>
                              </span>
                        @endif
                    </div>
                    <div class="form-group" {{ $errors->has('gender') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="pria" {{@$data['user']->gender == 'pria' ? 'checked' : ''}}> &nbsp; Pria &nbsp;
                          </label>
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="wanita" {{@$data['user']->gender == 'wanita' ? 'checked' : ''}}> Wanita
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" {{ $errors->has('last_name') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Birth Place 
                      </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" id="last-name" name="birth_place" value="{{@$data['user']->birth_place}}" class="form-control">
                      </div>
                    </div>
                    <div class="form-group" {{ $errors->has('last_name') ? ' has-error' : '' }}>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="date" value="{{@$data['user']->birth_date}}" name="birth_date" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Level <span class="required">*</span></label>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <select required name="role" class="form-control">
                              <option value="">Pilih level</option>
                              @foreach(@$data['role'] as $item)
                              <option value="{{@$item->id}}" {{old('role') == @$item->id ? "selected" : @$item->id == @$data['user']->role_id ? 'selected' : null}}>{{@$item->full_name}}
                              </option>
                              @endforeach
                          </select>
                          </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12" style="float: right; margin-left: 70px;">
                  <br>
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->
                        <a id="fancPreview" href="" class="fancPreview">
                          <img class="img-responsive avatar-view" id="img_url" src="{{ @$data['user'] ? url(@$data['user']->avatar) :  asset('images/users/userdefault.png') }}" alt="Avatar" title="Change the avatar" style="height: 300px;">
                        </a>
                      </div> <br>
                      <input {{@$data['user'] ?? 'required'}} name="file" id="imgInput" type="file" src="" alt=""
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