@extends('frontend.layout')
@section('css')
    <style>
    iframe{
        width: 100%;
        height: 100%;
    }
    </style>
@endsection

@section('meta')

@endsection

@section('content')
    <div class="tt-home__shipping-info-02" style="margin-top: -4.5%;">
        <div class="tt-shp-info tt-shp-info__design-02 tt-shp-info__align--left">
            <div class="row ttg-grid-padding--none ttg-grid-border ttg-grid-border-c--white">
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section tt-shp-info__align--left ">
                        <i class="icon-box"></i>
                        <div>
                            <div class="tt-shp-info__strong">Pengemasan Gratis</div>
                            <p>Pengemasan tidak dipungut biaya untuk semua produk.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section tt-shp-info__align--left ">
                        <i class="icon-thumbs-up-1"></i>
                        <div>
                            <div class="tt-shp-info__strong">Aman dan Tepercaya</div>
                            <p>Perusahaan yang telah resmi memiliki SIUP.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section tt-shp-info__align--left ">
                        <i class="icon-phone"></i>
                        <div>
                            <div class="tt-shp-info__strong">Siap Melayani</div>
                            <p>Pelayanan yang ramah dan selalu setia.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tt-page__section ttg-mb--40">
            <div class="tt-page__section-head tt-page__section-head--center tt-page__section-head--arrows">
                <div class="tt-page__title">Produk Terbaru</div>
                <div class="tt-page__arrows tt-page__arrows--in-head">
                    <span class="tt-page__arrows-prev"><i class="icon-left-open-2"></i></span>
                    <span class="tt-page__arrows-next"><i class="icon-right-open-2"></i></span>
                </div>
            </div>
            <div class="tt-carousel-box">
                <div class="tt-product-view">
                    <div class="tt-carousel-box__slider">
                        @foreach(@$data as $datas)
                        <div class="col-sm-6 col-xl-3">
                            <div class="tt-product tt-product__view-overlay ttg-text-animation-parent">
                                <div class="tt-product__image">
                                    <a href="{{url('products/'.@$datas->product_slug)}}">
                                        <img src="{{asset(@$datas->url)}}" data-srcset="{{asset(@$datas->product_url)}}"
                                             data-retina="{{asset(@$datas->url)}}"
                                             alt="Elegant and fresh. A most attractive mobile power supply.">
                                    </a>                                    
                                    <div class="tt-product__labels">
                                    @if($datas->discount_percent > 0)
                                    <span class="tt-label__sale">Diskon</span>
                                    <span class="tt-label__discount">{{$datas->discount_percent}}%</span>
                                    @endif
                                    </div>
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
                                    <span class="tt-price tt-price--sale">
                                        @if($datas->discount_percent > 0)
                                            @php
                                                $discount = ($datas->product_price-($datas->product_price*$datas->discount_percent/100));
                                                echo '<span>Rp'.$discount.'</span>'
                                            @endphp
                                                <span>Rp{{@$datas->product_price}}</span>
                                            @else
                                                <span>Rp{{@$datas->product_price}}</span>
                                        @endif
                                    </span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="tt-home__carousel-product">
            <div class="row">
                <div class="col-xl-4">
                    <div class="tt-page__section">
                        <div class="tt-page__section-head tt-page__section-head--arrows">
                            <div class="tt-page__title">Produk Populer</div>
                            <div class="tt-page__arrows tt-page__arrows--in-head tt-page__arrows--vertical">
                                <span class="tt-page__arrows-prev"><i class="icon-left-open-2"></i></span>
                                <span class="tt-page__arrows-next"><i class="icon-right-open-2"></i></span>
                            </div>
                        </div>
                        <div class="tt-carousel-box tt-carousel-box--vertical">
                            <div class="tt-product-view tt-product-view--list tt-product-view--preview">
                                <div class="tt-carousel-box__slider">
                                    @foreach(@$data as $datas)
                                    <div class="col-xs-12">
                                        <div class="tt-product tt-product__view-overlay ttg-text-animation-parent">
                                            <div class="tt-product__image">
                                                <a href="{{url('products/'.@$datas->product_slug)}}">
                                                    <img src="{{asset(@$datas->product_url)}}" data-srcset="{{asset(@$datas->product_url)}}"
                                                         data-retina="{{asset(@$datas->product_url)}}"
                                                         alt="Elegant and fresh. A most attractive mobile power supply.">
                                                </a>
                                                <div class="tt-product__labels">
                                                    @if($datas->discount_percent > 0)
                                                    <span class="tt-label__sale">Diskon</span>
                                                    <span class="tt-label__discount">{{$datas->discount_percent}}%</span>
                                                    @endif
                                                </div>
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
                                    <span class="tt-price tt-price--sale">
                                        @if($datas->discount_percent > 0)
                                            @php
                                                $discount = ($datas->product_price-($datas->product_price*$datas->discount_percent/100));
                                                echo '<span>'.$discount.'</span>'
                                            @endphp
                                                <span>Rp{{@$datas->product_price}}</span>
                                            @else
                                                <span>Rp{{@$datas->product_price}}</span>
                                        @endif
                                    </span>
                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-bottom: 50px; margin-top: -30px;">
        <div class="tt-page__section-head tt-page__section-head--center tt-page__section-head--arrows">
            <div class="tt-page__title">Kategori Produk</div>
        </div>
        <div class="row ttg-grid-pdg-btm--sm">
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-murah')}}" class="tt-promobox
                                                                                     ttg-text-animation-parent
                                                                                     ttg-image-translate--left
                                                                                     ttg-animation-disable--md
                                                                                     tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c1.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text "
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan Murah</div>
                        </div>
                        <div class="tt-promobox__hover tt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan Murah</span>
                                </div>

                                    <p class="ttg-text-animation--emersion">
                                @php
                                    $test = $data->where('category_name', '=', 'Undangan Murah')->count();
                                        echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                @endphp
                                    </p>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-mewah')}}" class="tt-promobox
                                                                                       ttg-text-animation-parent
                                                                                       ttg-image-scale
                                                                                       ttg-animation-disable--md
                                                                                       tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c3.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text "
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan Mewah</div>
                        </div>
                        <div class="tt-promobox__hover tt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan Mewah</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    @php
                                        $test = $data->where('category_name', '=', 'Undangan Mewah')->count();
                                            echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-soft-cover')}}" class="tt-promobox
                                                                                       ttg-text-animation-parent
                                                                                       ttg-image-translate--top
                                                                                       ttg-animation-disable--md
                                                                                       tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c2.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text"
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan SoftCover</div>
                        </div>
                        <div class="tt-promobox__hovertt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan SoftCover</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    @php
                                        $test = $data->where('category_name', '=', 'Undangan Soft Cover')->count();
                                            echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row ttg-grid-pdg-btm--sm" style="margin-top: 20px;">
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-hard-cover')}}" class="tt-promobox
                                                                                     ttg-text-animation-parent
                                                                                     ttg-image-translate--left
                                                                                     ttg-animation-disable--md
                                                                                     tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c5.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text "
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan HardCover</div>
                        </div>
                        <div class="tt-promobox__hover tt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan HardCover</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    @php
                                        $test = $data->where('category_name', '=', 'Undangan Hard Cover')->count();
                                            echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-promo')}}" class="tt-promobox
                                                                                       ttg-text-animation-parent
                                                                                       ttg-image-scale
                                                                                       ttg-animation-disable--md
                                                                                       tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c6.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text "
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan Promo</div>
                        </div>
                        <div class="tt-promobox__hover tt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan Promo</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    @php
                                        $test = $data->where('category_name', '=', 'Undangan Promo')->count();
                                            echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{url('products/categories/undangan-unik')}}" class="tt-promobox
                                                                                       ttg-text-animation-parent
                                                                                       ttg-image-translate--top
                                                                                       ttg-animation-disable--md
                                                                                       tt-promobox__hover-disable--md">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset('f/assets/images/promoboxes/c4.jpg')}}" alt="Image name">
                        <div class="tt-promobox__text"
                             data-resp-md="md"
                             data-resp-sm="lg"
                             data-resp-xs="sm">
                            <div class="colorize-theme2-c" style="color: black !important;">Undangan Unik</div>
                        </div>
                        <div class="tt-promobox__hovertt-promobox__hover--fade">
                            <div class="tt-promobox__hover-bg colorize-theme4-bg"></div>
                            <div class="tt-promobox__text tt-promobox__point-lg--center">
                                <div class="ttg-text-animation--emersion">
                                    <span class="colorize-theme2-c">Undangan Unik</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    @php
                                        $test = $data->where('category_name', '=', 'Undangan Unik')->count();
                                            echo '<span class="colorize-theme2-c"><span class="colorize-theme-c">'. $test.'</span> produk</span>'
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="tt-page__name-sm text-center">
        <h2>Tertarik Ingin Bekerja Sama?</h2>
        <h6 style="font-size: 16px; margin-top: 10px;">Pecinta Desain Grafis? Ingin menyalurkan karya sekaligus menambah penghasilan? Here We Are! Tunggu apalagi, segera daftarkan diri Anda! Berpenghasilan, karya tersalurkan dan bermanfaat pula. <br> Tanpa harus terikat kontrak! </h6>
        <a href="{{route('frontend.register.indexdesigner')}}" class="btn">Ayo Bergabung</a>
    </div>
@stop
