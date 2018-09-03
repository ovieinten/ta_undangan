@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Kontak Kami</h1>
    </div>

    <div class="tt-contacts">
        <div class="tt-contacts__adress">
            <div class="row ttg-grid-padding--none">
                <div class="col-md-6">
                    <div class="tt-contacts__map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.818113769855!2d109.31484121420644!3d-0.01843733556084837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58ed3a2e5ef3%3A0x60e73d63ca9c6773!2sAksara+Indah.+PD!5e0!3m2!1sen!2sid!4v1531240766410" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tt-contacts__info">
                        <div class="tt-contacts__info_text text-center">
                            <p>Alamat: Jl. Jeranding No.5, Kota Pontianak, Kal-Bar</p>
                            <p>Telepon: +62852 1508 8366</p>
                            <p>Jam Buka : Senin - Sabtu, pukul 9.00 – 16.30 WIB</p>
                            <p>E-mail: <a href="mailto:info@mydomain.com">info@mydomain.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop