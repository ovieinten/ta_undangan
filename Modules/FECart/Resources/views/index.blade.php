@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Keranjang Belanja</h1>
    </div>

    <div class="tt-cart">
        <div class="row">
            <div class="col-lg-12">
            @if(count($cart))
                    <div class="tt-cart__caption">
                        <div class="row">
                            <div class="col-md-2"><span>Produk</span></div>
                            <div class="col-md-4 text-left"><span>Deskripsi</span></div>
                            <div class="col-md-2 text-center"><span>Harga</span></div>
                            <div class="col-md-2 text-center"><span>Jumlah</span></div>
                            <div class="col-md-2 text-center"><span>Total</span></div>
                        </div>
                    </div>
                    @foreach($cart as $item)
                            <div class="tt-cart__list">
                                <div class="tt-cart__product">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="tt-cart__product_image"><img
                                                    src="images/cart/cart-01.jpg" alt="Image name"></a>
                                            <div class="tt-cart__product_info">
                                                <a href="#"><p>{{$item->name}}</p></a>
                                                <p>Web ID: {{$item->id}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-4 text-center">
                                            <div class="tt-cart__product_price">
                                                <div class="tt-price">
                                                    <span>Rp{{$item->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-4 text-center">
                                            <div class="tt-counter tt-counter__inner" data-min="1" data-max="10">
                                                <a class="cart_quantity_up" href=""> + </a>
                                                    <input class="cart_quantity_input" type="text" name="quantity"
                                           value="{{$item->qty}}" autocomplete="off" size="2">
                                                <a class="cart_quantity_down" href=""> - </a>
                                                <div class="tt-counter__control">
                                                    <span class="icon-up-circle" data-direction="next"></span>
                                                    <span class="icon-down-circle" data-direction="prev"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-4 text-center">
                                            <div class="tt-cart__product_price">
                                                <div class="tt-price">
                                                    <span>Rp{{$item->subtotal}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    @else
                    <p>Kamu tidak mempunyai item di keranjang belanja</p>
                @endif
            </div>
        </div>
    </div>
    
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop