@extends('backend.layout')

@section('style')
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css"
          type="text/css">
    <link href="{{asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    </head>
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

        input[type=file]{
            display: inline;
        }

        #image_preview{
            padding: 10px;
        }

        #image_preview img{
            width: 200px;
            padding: 5px;
        }
    </style>
@stop

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Karya</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.dashboard.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Karya</li>
                </ol>
            </div>
        </div>
    </div>
    <form action="{{@$data['creation'] ? route('backend.creation.update', ['slug' => @$data['creation']->slug]) : route('backend.creation.store')}}" enctype="multipart/form-data" method="post" onsubmit="ShowLoading()">
        {{csrf_field()}}
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 50px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" required type="text" id="name" name="name" value="{{ @$data['creation']->name }}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea required id="desc" name="desc" style="width: 100%;" readonly="">{{ @$data['creation']->desc }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shape</label>
                            <div class="input-group">
                                <select required name="shape" class="select-form-advance js-select2 form-control" readonly="">
                                    <option readonly selected value>Pilih Bentuk</option>
                                    @foreach(@$data['shape'] as $item)
                                        <option value="{{@$item->id}}" {{old('shape') == @$item->id ? "selected" : @$item->id == @$data['creation']->shape_id ? 'selected' : null}}>{{@$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Size</label>
                            <div class="input-group">
                                <select required name="size" class="select-form-advance js-select2 form-control" readonly="">
                                    <option readonly selected value>Pilih Ukuran</option>
                                    @foreach(@$data['size'] as $item)
                                        <option value="{{@$item->id}}" {{old('size') == @$item->id ? "selected" : @$item->id == @$data['creation']->size_id ? 'selected' : null}}>{{@$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Color</label>
                            <div class="input-group">
                                <select required name="color" class="select-form-advance js-select2 form-control" readonly="">
                                    <option readonly selected value>Pilih Warna</option>
                                    @foreach(@$data['color'] as $item)
                                        <option value="{{@$item->id}}" {{old('color') == @$item->id ? "selected" : @$item->id == @$data['creation']->color_id ? 'selected' : null}}>{{@$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="input-group">
                                <select required name="status" class="form-control" readonly="">
                                    <option value="">Pilih Status</option>
                                    <option value="sent" {{old('status') == "sent" ? "selected" : @$data['creation']->status == 'sent' ? 'selected' : null}}>
                                        Sent
                                    </option>
                                    <option value="accepted" {{old('status') == "accepted" ? "selected" : @$data['creation']->status == 'accepted'  ? 'selected' : null}}>
                                        Accepted
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" required type="text" id="" name="price" value="{{ @$data['creation']->price }}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <br>
                            <label>*Jika karya diterima, maka designer mendapat komisi sebesar 10% dari harga jual per-produk. Silahkan tentukan harga jual karya Anda.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Photo Creation</label><br>
                            <input class="form-control" name="photos[]" type="file" id="uploadFile" multiple value="{{@$data['photo_creation'] ? url(@$data['photo_creation']->url) : null}}" hidden="">
                                @foreach(@$data['creation']->photo_creation as $item)
                                <img src="{{asset(@$item->url) }}" alt="foto produk" id="image_preview" style="width: 300px; display: inline; float: left;" />
                                @endforeach
                            <div id="image_preview"></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <button onclick="goBack()" class="btn btn-success" style="float: right; margin-bottom: 20px;">Kembali</button>
            </div>
        </div>
    </form>
@stop

@section('script')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"
            type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script type="text/javascript">
        $("#uploadFile").change(function(){
            $('#image_preview').html("");
            var total_file=document.getElementById("uploadFile").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
            }
        });
    </script>

    <script>
        function ShowLoading(e){
            $("#loading").slideDown("slow");
        }
        $('.wysiwyg').ckeditor({
            height: '1500px',
            width: '100%',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $("input[name=_token]").val(),
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $("input[name=_token]").val(),
        });
    </script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@stop