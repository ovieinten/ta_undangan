@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-gallery">
        <div class="row ttg-grid-padding--none " style="margin-bottom: 30px;">
        	@foreach($data as $photos)
            <div class="col-sm-6 col-lg-4"><a href="#"
                                                  data-photo="{{asset( $photos->product_url) }}"
                                                  data-title="{{@$photos->product_name}}"
                                                  data-tags="{{@$photos->category_name}}" class="tt-promobox
   tt-promobox__size-square           ttg-text-animation-parent
   ttg-image-translate--top           ttg-animation-disable--sm
   tt-promobox__hover-disable--sm">
                    <div class="tt-promobox__content">
                        <img data-srcset="{{asset( $photos->product_url) }}" alt="Image name">
                        <div class="tt-promobox__hover">
                            <div class="tt-promobox__hover-bg"></div>
                            <div class="tt-promobox__text">
                                <div class="ttg-text-animation--emersion">
                                    <span>{{@$photos->product_name}}</span>
                                </div>
                                <p class="ttg-text-animation--emersion">
                                    <span>{{@$photos->category_name}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        	@endforeach
        </div>
        {{@$data->links('pagination')}}
        <div class="tt-gallery__slider">
            <!-- Add Arrows -->
            <span class="swiper-btn-next icon-right-open-big"></span>
            <span class="swiper-btn-prev icon-left-open-big"></span>
            <!--sliders-->
            <div class="swiper-container gallery-top"></div>
            <div class="swiper-container gallery-thumbs"></div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop
