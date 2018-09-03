@extends('frontend.single_layout')

@section('meta')

@stop

@section('style')

@stop

{{--@section('hero_title', $heroFill['name'])--}}

@section('content')
    <div class="tt-product-head tt-sticky-block__parent">
        <div class="tt-product-head__sticky tt-sticky-block tt-layout__mobile-full">
            <div class="tt-product-head__images tt-sticky-block__inner tt-product-head__single-mobile ">
                <div class="tt-product-head__image-main">
                    @foreach(@$data->photos as $datas)
                        <img src="{{asset(@$datas->url)}}"
                             data-zoom-image="{{asset(@$datas->url)}}" data-full="#"
                             alt="Image name">
                    @endforeach
                </div>
                <div class="tt-product-head__image-preview">
                    @foreach(@$data->photos as $datas)
                        <img src="{{asset(@$datas->url)}}" alt="Image name">
                    @endforeach
                </div>

            </div>
        </div>
        <div class="tt-product-head__sticky tt-sticky-block">
            <div class="tt-product-head__info tt-sticky-block__inner">
                <form action="#">
                    <div class="tt-product-head__category"><a
                                href="listing-with-custom-html-block.html">{{@$data->category->name}}</a>
                    </div>
                    <div class="tt-product-head__name"><h1>{{@$data->name}}</h1></div>
                    <div class="tt-product-head__review">
                        <div class="tt-product-head__stars
	        tt-stars">
                            <span class="ttg-icon"></span>
                            <span class="ttg-icon" style="width: 70%;"></span>
                        </div>
                        <div class="tt-product-head__review-count"><a href="#">2 Review(s)</a></div>
                        <div class="tt-product-head__review-add"><a href="#">Add Your Review</a></div>
                    </div>
                    <div class="tt-product-head__price">
                        <div class="tt-price tt-price--sale">
                            @if(@$data->discount->percent != '')
                                @php
                                    $discount = ($data->price-($data->price*$data->discount->percent/100));
                                    echo '<span>Rp'.$discount.'</span>'
                                @endphp
                                <span>Rp{{@$data->price}}</span>
                            @else
                                <span>Rp{{@$data->price}}</span>
                        @endif
                        <!-- <span>Rp{{@$data->price}}</span> -->
                        </div>
                    </div>
                    @if(@$data->discount != "")
                        <div class="tt-product-head__sale">
                            <div class="tt-product-head__sale-info">
                                <div>{{@$data->discount->percent}}% Off</div>
                            </div>
                            <div class="tt-product-head__sale-countdown">
                                <div class="tt-product-head__countdown" style="color: black;" data-date="2018-06-01">
                                    until {{@$data->discount->date_end}}</div>
                            </div>
                        </div>
                    @endif
                    <div class="tt-product-head__more-detailed"><p>{{@$data->desc}}</p>
                    </div>
                    <div class="tt-product-head__control">
                        <a href="{{route('frontend.product.cart', ['slug' => @$data->slug, 'prod_id' => @$data->id])}}" style="background-color: #1cc373; border-color: #1cc373; padding: 20px; border-radius: 3px;"><i class="icon-shop24"><span style="color: white;">Add to Cart</span></i></a>
                        </div>
                    </div>
                    <div class="addthis_inline_share_toolbox"></div>
                    <div class="tt-product-head__video tt-video">
                        <!--<video src="media/video-01.mp4" controls="controls"></video>-->
                        <iframe src="https://www.youtube.com/embed/AoPiLg8DZ3A" frameborder="0"
                                allowfullscreen></iframe>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="tt-product-page__tabs tt-tabs tt-layout__mobile-full" data-tt-type="horizontal">
        <div class="tt-tabs__head">
            <div class="tt-tabs__slider">
                <div class="tt-tabs__btn" data-tab="review"><span>Reviews</span></div>
            </div>
            <div class="tt-tabs__btn-prev"></div>
            <div class="tt-tabs__btn-next"></div>
            <div class="tt-tabs__border"></div>
        </div>
        <div class="tt-tabs__body tt-tabs-product">
            @if(\Illuminate\Support\Facades\Auth::check())
                <div>
                    @if(sizeof($checkRating) == 0)
                        <form action="{{route('frontend.product.review', ['slug' => @$data->slug])}}" method="post">
                            @csrf
                            <div class="tt-tabs__content">
                                <div class="tt-tabs-product__review tt-review-shopify">
                                    <div id="shopify-product-reviews" data-id="8934519185">
                                        <div class="spr-container">
                                            <div class="spr-header">
                                                <h2 class="spr-header-title">Customer Reviews</h2>
                                                <div class="spr-summary" itemscope="" itemprop="aggregateRating"
                                                     itemtype="">
                                                    <input id="input-id" name="rate" class="rating rating-loading"
                                                           data-min="0"
                                                           data-max="5" data-step="1"
                                                           value="0"
                                                           data-size="xs">

                                                    <input type="hidden" name="id" required=""
                                                           value="{{ @$data->id }}">
                                                    <div class="tt-product-head__review-count"><a href="#">&nbsp; X
                                                            Reviews</a></div>
                                                </div>
                                            </div>
                                            <br/>
                                        </div>
                                        <button class="btn btn-success">Masukkan Umpan Balik</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <h5 class="spr-header-title">Anda sudah melakukan umpan balik</h5>
                    @endif
                </div>
            @else
                <h5 class="spr-header-title">Silahkan login terlebih dahulu untuk melakukan umpan balik</h5>
            @endif
        </div>
    </div>
    @if(!empty($related))
        <div class="tt-product-page__upsell">
            <div class="tt-product-page__upsell-title">You may also be interested in the follwing
                product(s)
            </div>
            <div class="tt-carousel-box">
                <div class="tt-product-view">
                    <div class="tt-carousel-box__slider">
                        @foreach(@$data as $datas)
                            <div class="col-sm-6 col-xl-3">
                                <div class="tt-product tt-product__view-overlay ttg-text-animation-parent">
                                    <div class="tt-product__image">
                                        <a href="product-simple-variant-1.html">
                                            <img src="{{asset(@$datas->product->url)}}"
                                                 data-srcset="{{asset(@$datas->product->url)}}"
                                                 data-retina="{{asset(@$datas->product->url)}}">
                                        </a>
                                    </div>
                                    <div class="tt-product__hover tt-product__clr-clk-transp">
                                        <div class="tt-product__content">
                                            <h3>
	                        <span class="ttg-text-animation--emersion">
                                    <a href="{{url('products/'.@$datas->product->slug)}}">{{@$datas->product->name}}</a>
                                </span>
                                            </h3>
                                            <p>
                            <span class="ttg-text-animation--emersion">
                                <a href="{{url('products/'.@$datas->product->slug)}}">{{@$datas->product->desc}}</a>
                            </span>
                                            </p>
                                            <div class="ttg-text-animation--emersion">
	                        <span class="tt-product__price">
	                            <span class="tt-price">
	                                <span>Rp{{@$datas->product->price}}</span>
	                            </span>
	                        </span>
                                            </div>
                                            <div class="ttg-text-animation--emersion">
                                                <div class="tt-product__stars tt-stars">
                                                    <span class="ttg-icon"></span>
                                                    <span class="ttg-icon" style="width:35%;"></span>
                                                </div>
                                            </div>
                                            <div class="ttg-text-animation--emersion">
                                                <div class="tt-product__buttons">
                                                    <a href="#" class="tt-btn colorize-btn5 tt-product__buttons_cart">
                                                        <i class="icon-shop24"></i>
                                                        <span>Add to Cart</span>
                                                    </a>
                                                    <a href="#" class="tt-btn colorize-btn4 tt-product__buttons_qv">
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
            </div>
        </div>
    @endif
@stop

@section('scripting')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
    {{--RATING--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <script type="text/javascript">

        $("#input-id").rating();

    </script>


@stop
