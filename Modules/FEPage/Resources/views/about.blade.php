@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Tentang Kami</h1>
    </div>

    <div class="tt-about">
        <div class="row ttg-grid-padding--none">
            <div class="col-md-6">
                <a href="{{asset('f/assets/images/about/pendiri.jpg')}}" class="ttg-image-translate--left ttg-animation-disable--sm"><img
                        data-srcset="{{asset('f/assets/images/about/pendiri.jpg')}}" alt="Image name"></a>
            </div>
            <div class="col-md-6">
                <div class="tt-about__info">
                    <div>Fakta Menarik</div>
                    <p>PD. Aksara Indah merupakan perusahan dagang yang bergerak di bidang offset printing, berlokasi Kota Pontianak, Kalimantan Barat. Kerennya, sang pemilik, Muhammad Maulana Zulkarnain sering turut andil dalam segala proses pengerjaan pemesanan, seperti desain produk, melayani pembeli, pengemasan, dsb.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tt-about__info">
                    <div>Produk yang Ditawarkan</div>
                    <p>Kami tak hanya melayani pemesanan jasa cetak undangan namun, juga melayani segala jenis hasil cetak, seperti buku, kalender, brosur dan semua hasil cetakan lainnya secara offline. Kami melayani jumlah sedikit maupun banyak serta dalam maupun luar kota. Jika, Anda memiliki pertanyaan lebih lanjut, silahkan hubungi kontak kami.</p>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{asset('f/assets/images/about/produk.jpg')}}" class="ttg-image-scale ttg-animation-disable--sm"><img
                        data-srcset="{{asset('f/assets/images/about/produk.jpg')}}" alt="Image name"></a>
            </div>
        </div>
    </div>


    <div class="tt-page__name-sm text-center">
        <h2>Tertarik Ingin Bekerja Sama?</h2>
        <h6 style="font-size: 16px; margin-top: 10px;">Pecinta Desain Grafis? Ingin menyalurkan karya sekaligus menambah penghasilan? Here We Are! Tunggu apalagi, segera daftarkan diri Anda! Berpenghasilan, karya tersalurkan dan bermanfaat pula. <br> Tanpa harus terikat kontrak! </h6>
        <a href="{{route('frontend.register.indexdesigner')}}" class="btn">Ayo Bergabung</a>
    </div>

    <div class="tt-post ttg-mt--100">
        <div class="tt-post__slider tt-post__slider--bg">
            <div class="tt-post__content-quote">
                <i class="icon-quote-1"></i>
                <div class="tt-post__content-quote_title">Datang bersama adalah awal, kebersamaan adalah kemajuan </br>dan bekerja bersama adalah keberhasilan!
                </div>
                <div class="tt-post__content-quote_quote">– Henry Ford</div>
            </div>
            <div class="tt-post__content-quote">
                <i class="icon-quote-1"></i>
                <div class="tt-post__content-quote_title">Every human being is a Designer!
                </div>
                <div class="tt-post__content-quote_quote">– Norman Potter</div>
            </div>
            <div class="tt-post__content-quote">
                <i class="icon-quote-1"></i>
                <div class="tt-post__content-quote_title">Tak seorang pun mampu menganggap diri Anda rendah, </br> kecuali dengan persetujuan Anda!
                </div>
                <div class="tt-post__content-quote_quote">– Eleanor Roosevelt</div>
            </div>
        </div>
        <div class="tt-post__slider-nav tt-post__slider-nav--fixed-c tt-post__slider-nav--dark tt-post__slider-nav--arrows-none"></div>
    </div>
    <script>
        require(['app'], function () {
            require(['modules/sliderBlog']);
        });
    </script>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop