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
                    <div class="tt-checkout__step-01">
                        <span>01</span>
                        <p>Pengiriman</p>
                    </div>
                    <div class="tt-checkout__step-02">
                        <span>02</span>
                        <p>Pembayaran</p>
                    </div>
                </div>
                <h4 class="ttg-mt--50 ttg-mb--20">Alamat Pengiriman</h4>
                <form action="{{route('frontend.order.store')}}" enctype="multipart/form-data" method="post" onsubmit="ShowLoading()">
                {{csrf_field()}}
                <div class="tt-checkout__form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Produk</label>
                            <div class="input-group">
                                <select required name="product" id="select" class="form-control select-produk">
                                <option disabled selected value>Pilih Produk</option>
                                @foreach(@$data['product'] as $item)
                                    <option value="{{@$item->id}}" {{old('product') == @$item->id ? "selected" : @$item->id == @$data['order']->product_id ? 'selected' : null}}>{{@$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <input type="date" value="{{@$data['order']->date}}" name="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <div class="input-group">
                                <input type="text" value="{{@$data['order']->qty}}" onkeyup="keyQty()" id="qty_produk" name="qty" class="form-control qty_produk">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                                <input type="text" value="{{@$data['order']->price_total}}" id="price_total" name="price_total" class="form-control price_total" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Diskon</label>
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                                <input type="text" value="{{@$data['order']->discount_total}}" readonly id="discount_total" name="discount_total" class="form-control discount_total">
                                <input type="hidden" name="discount" id="discount" class="discount" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah Total</label>
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                                <input type="text" value="{{@$data['order']->grand_total}}" id="grand_total" name="grand_total" class="grand_total form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Handphone</label>
                            <div class="input-group">
                                <input type="text" value="{{@$data['order']->number}}" name="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <div class="input-group">
                                <input type="text" value="{{@$data['order']->post_code}}" name="post_code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select required class="select-form-advance js-select2 form-control" name="province" data-url="{{ route('api.select2.get.location').'?select2=yes&showDesc=yes&location_type=provinsi' }}" name="order[province_id]" style="width: 100%;" data-placeholder="Pilih Provinsi...">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kota/Kabupaten</label>
                            <select required class="select-form-advance js-select2 form-control" name="regence" data-url="{{ route('api.select2.get.location').'?select2=yes&showDesc=yes&location_type=kota/kabupaten' }}" name="order[regency_id]" name="book_product_id" style="width: 100%;" data-placeholder="Pilih Kota/Kabupaten...">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select required class="select-form-advance js-select2 form-control" name="district" data-url="{{ route('api.select2.get.location').'?select2=yes&showDesc=yes&location_type=kecamatan' }}" name="order[district_id]" style="width: 100%;" data-placeholder="Pilih Kecamatan...">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Desa/Kelurahan</label>
                            <select required class="select-form-advance js-select2 form-control" name="village" data-url="{{ route('api.select2.get.location').'?select2=yes&showDesc=yes&location_type=desa/kelurahan' }}" name="order[village_id]" style="width: 100%;" data-placeholder="Pilih Desa/Kelurahan...">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <div class="input-group">
                                <textarea required id="desc" name="address" style="width: 100%">{{ @$data['order']->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                </div>
                </form>
                <div class="tt-checkout--border">
                    <button type="submit" class="btn btn-primary" style="float: right; margin-bottom: 10px;">Kirim</button></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tt-summary">
                    <div class="tt-summary--border">
                        <h5 class="ttg-mb--20">Catatan</h5>
                        <p>Tulis permintaan khususmu...</p>
                        <textarea required id="desc" name="desc" style="width: 100%;" class="form-control">{{ @$data['order']->desc }}</textarea>
                    </div>
                    <script>
                        require(['app'], function () {
                            require(['modules/toggleProductParam']);
                        });
                    </script>
                    <div class="tt-summary--border">
                        <div class="tt-summary__total">
                            <p>Total: <span>{{@$data['order']->grand_total}}</span></p>
                        </div>
                    </div>
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
