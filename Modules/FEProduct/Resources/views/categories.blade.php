@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-listing-page__category-name"><h1>Produk</h1></div>
    <div class="tt-listing-page__view-options tt-vw-opt">
        <div class="row">
            {{csrf_field()}}
            <div class="col-xl-6 col-lg-5 col-md-5 col-xs-12">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                <div class="tt-vw-opt__grid">
                    <div class="tt-product-btn-vw" data-control=".tt-product-view">
                        <label>
                            <input type="radio" name="product-btn-vw" checked>
                            <i class="icon-th-large"></i>
                            <i class="icon-check-empty"></i>
                        </label>
                        <label>
                            <input type="radio" name="product-btn-vw"
                                   data-view-class="tt-product-view--list">
                            <i class="icon-th"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tt-listing-page__products tt-layout__mobile-full">

        <div class="tt-product-view row">
            @foreach(@$data as $datas)
                <div class="col-sm-6 col-xl-4 col-xxl-3">
                    <div class="tt-product tt-product__view-overlay ttg-text-animation-parent">
                        <div class="tt-product__image">
                            <a href="product-simple-variant-1.html">
                                <img src="{{asset(@$datas->url)}}" data-srcset="{{asset(@$datas->product_url)}}"
                                     data-retina="images/products/product-07.jpg"
                                     alt="Elegant and fresh. A most attractive mobile power supply.">
                            </a>
                        </div>
                        <div class="tt-product__hover tt-product__clr-clk-transp">
                            <div class="tt-product__content">
                                <h3>
                            <span class="ttg-text-animation--emersion">
                                <a href="{{url('products/'.@$datas->product_slug)}}">{{@$datas->product_name}}</a>
                            </span>
                                </h3>
                                <p>
                            <span class="ttg-text-animation--emersion">
                                <a href="{{url('products/'.@$datas->product_slug)}}">{{@$datas->product_desc}}</a>
                            </span>
                                </p>
                                <div class="ttg-text-animation--emersion">
                            <span class="tt-product__price">
                                <span class="tt-price">
                                    <span>Rp{{@$datas->product_price}}</span>
                                </span>
                            </span>
                                </div>
                                <div class="ttg-text-animation--emersion">
                                    <div class="tt-product__buttons">
                                        <a href="#" class="tt-btn colorize-btn5 tt-product__buttons_cart">
                                            <i class="icon-shop24"></i>
                                            <span>Add to Cart</span>
                                        </a>
                                        <a href="{{url('products/'.@$datas->product_slug)}}" class="tt-btn colorize-btn4 tt-product__buttons_qv">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{@$data->links('pagination')}}

@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop
