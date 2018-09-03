@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Pemesanan</h1>
    </div>

    <div class="tt-checkout">
        <div class="row">
            <div class="col-lg-8">
                <div class="tt-checkout__steps">
                    <div class="tt-checkout__step-02">
                        <span>01</span>
                        <p>Pengiriman</p>
                    </div>
                    <div class="tt-checkout__step-01">
                        <span>02</span>
                        <p>Pembayaran</p>
                    </div>
                </div>
                <h4 class="ttg-mt--50 ttg-mb--20">Alamat Pengiriman</h4>
                <form action="{{route('frontend.order.store')}}" enctype="multipart/form-data" method="post" onsubmit="ShowLoading()">
                {{csrf_field()}}
                <div class="tt-checkout__form">
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
                                      <option value="{{@$item->id}}" {{old('order') == @$item->id ? "selected" : @$item->id == @$data['payment']->order_id ? 'selected' : null}}>{{@$item->order_number}}</option>
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
                <div class="tt-checkout--border">
                    <button type="submit" class="btn btn-primary" style="float: right; margin-bottom: 10px;">Kirim</button></a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
    <script src="{{ url('js/custom.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"
            type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#select").show(function(){
                //select2 custom
                jQuery(function () {
                    Custom.initmSelect2();
                });
            });
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
        $(".fancPreview")
            .attr('rel', 'gallery')
            .fancybox({
                padding: 0,
                afterShow: function () {
                    $('.fancybox-button--zoom').click();
                }
            });

            /* select-produk */

            function keyQty()
            {
                var value = $('#qty_produk').val();
                var price = $('.price_total');
                var discount = $('.discount'); // ini input tipe hideen

                // target haa
                var discount_total = $('.discount_total');
                var grand_total = $('.grand_total');

                if (value != "") {
                     if (discount.val() > 0) {
                        /*hitung discout*/
                        // rumus total discount = qty * price * discount / 100; 
                        // rumus grand total = (qty * price) - total discount;

                        var dtotal = (parseInt(value) * parseInt(price.val()) * parseInt(discount.val())) / 100;
                        var gtotal = (parseInt(value) * parseInt(price.val())) - parseInt(dtotal);
                        discount_total.val(dtotal);
                        grand_total.val(gtotal);


                    }else if (discount.val() <= 0){
                        /*hitung tanpa discount*/

                        var gtotal = (parseInt(value) * parseInt(price.val()));
                        discount_total.val(0);
                        grand_total.val(gtotal);
                    }
                }else{
                        discount_total.val(0);
                        grand_total.val(0);
                }
            }

            $(document).ready(function(){

                $('.select-produk').on('change',function(){
                    var id = $(this).val();
                    var url = "{{ url('b/order/getdataproduk') }}/" + id;

                     $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {

                            if (data.status) {
                                var data = data.data;

                               $('#price_total').val(data.price);
                               var dis = $('#discount');
                               if (data.discount != null) {
                                dis.val(data.discount.percent);
                               }else{
                                dis.val(0);
                               }

                               keyQty();
                            } else {
                                alert("Gagal Mengambil Data");
                            }
                        },
                        error: function (err) {
                            alert("Gagal Mengambil Data");
                        }
                    });

                   
                });

            });
    </script>
@stop
