@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name-sm text-center">
        <h2>Pemesanan Offline</h2>
        <p>Silahkan berkunjung ke Jalan Jeranding No.5, Kota Pontianak, Kalimantan Barat. Kami buka setiap hari Senin - Sabtu pukul 9.00 – 16.30 WIB</p>
    </div>
    <div class="ttg-mt--30">
        <div class="ttg-image-scale">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.818113769855!2d109.31484121420644!3d-0.01843733556084837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58ed3a2e5ef3%3A0x60e73d63ca9c6773!2sAksara+Indah.+PD!5e0!3m2!1sen!2sid!4v1531240766410" frameborder="0" width="100%" height="300" style="border:0" allowfullscreen></iframe>
        </div>
    </div>

    <div class="tt-home__shipping-info-01">
    <div class="tt-page__name-sm text-center">
        <h2>Pemesanan Online</h2>
    </div>
        <div class="tt-shp-info tt-shp-info__design-04 tt-shp-info__design-striped" style="margin-top: -10%;">
            <div class="row ttg-grid-padding--none">
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">1</span>
                        <div class="tt-shp-info__strong">Pilih Produk yang Diinginkan</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">2</span>
                        <div class="tt-shp-info__strong">Catat Detail Produk</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">3</span>
                        <div class="tt-shp-info__strong">Hubungi Customer Service</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="tt-shp-info tt-shp-info__design-04 tt-shp-info__design-striped" style="margin-top: -25%;">
            <div class="row ttg-grid-padding--none">
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">4</span>
                        <div class="tt-shp-info__strong">Pembayaran 30%</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">5</span>
                        <div class="tt-shp-info__strong">Konfirmasi Pembayaran</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">6</span>
                        <div class="tt-shp-info__strong">Proses Pengerjaan Pemesanan</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="tt-shp-info tt-shp-info__design-04 tt-shp-info__design-striped" style="margin-top: -25%;">
            <div class="row ttg-grid-padding--none">
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">7</span>
                        <div class="tt-shp-info__strong">Pelunasan Biaya</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">8</span>
                        <div class="tt-shp-info__strong">Pengiriman Pesanan</div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" class="tt-shp-info__section ">
                        <span class="tt-shp-info__number">9</span>
                        <div class="tt-shp-info__strong">Pesanan Sampai di Konsumen</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop