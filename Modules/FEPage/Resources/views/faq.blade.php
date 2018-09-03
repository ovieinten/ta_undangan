@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name-sm text-center">
        <h2>Pertanyaan Umum</h2>
    </div>

    <div class="tt-page__cont-small">
        <div class="tt-faq tt-faq--arrow">
            <i class="icon-right-open"></i>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Apakah konsumen dapat meminta perubahan desain yang sudah ada ?</h5>
                </div>
                <p>Ya bisa. Silahkan hubungi pelayanan konsumen kami.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Apakah ada ketentuan file desain dari konsumen?</h5>
                </div>
                <p>Tidak ada ketentuan. Kami siap menerima file dalam bentuk apapun.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Bagaimana prosedur desain undangan hingga akhirnya mencapai kesepakatan?</h5>
                </div>
                <p>Kami akan mengirimkan draft desain dalam format .jpg dengan ukuran sama seperti undangan yang Anda pesan. Jika, belum sesuai dengan keinginan, Anda bisa melakukan perubahan hingga Anda menyetujuinya. Saat undangan Anda sudah sesuai dengan permintaan, kami akan memulai memproduksinya.</p>
            </div>
        </div>
    </div>
    <div class="tt-page__name-sm text-center">
        <h2>Pertanyaan Pemesanan</h2>
    </div>

    <div class="tt-page__cont-small">
        <div class="tt-faq tt-faq--arrow">
            <i class="icon-right-open"></i>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Bagaimana cara melakukan pemesanan secara online?</h5>
                </div>
                <p>Silahkan lihat di cara pemesanan.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Apakah ada jumlah minimum pemesanan?</h5>
                </div>
                <p>Tidak ada, semakin banyak pemesanan maka harganya semakin murah.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Bagaimana penentuan harga undangan?</h5>
                </div>
                <p>Ada beberapa faktor selain jumlah, yaitu ukuran, warna tipe kertas, aksesoris, dan kemuritan pengerjaan.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Bagaimana mengetahui harga dari undangan yang konsumen pesan?</h5>
                </div>
                <p>Anda dapat melihat pada detail produk undangan. Halaman tersebut terdapat spesifikasi dan harga.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Berapa lama proses pengerjaan?</h5>
                </div>
                <p>Lama pengerjaan tergantung dengan jenis produk dan kerumitan undangan. Waktu selesai akan diberitahukan ketika proses produksinya selesai.</p>
            </div>
        </div>
    </div>

    <div class="tt-page__name-sm text-center">
        <h2>Pertanyaan Pembayaran</h2>
    </div>

    <div class="tt-page__cont-small">
        <div class="tt-faq ttg-mb--100">
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Seperti apa mekanisme pembayaran?</h5>
                </div>
                <p>Jika pemesanan sudah mencapai kesepakatan, maka konsumen membayar uang muka 30 % terlebih dahulu. Untuk pelunasan bisa dibayar setelah proses produksi selesai ditambah ongkos pengiriman bila ada.</p>
            </div>
            <div class="tt-faq__section">
                <div class="tt-faq__section_head">
                    <i class="icon-down-open"></i>
                    <h5>Metode pembayaran apa saja yang tersedia?</h5>
                </div>
                <p>Kami menyediakan metode pembayaran tunai dan transfer. Mohon diperhatikan pembayaran hanya akan dianggap lunas apabila dana sudah cair/diterima oleh kami. Konfirmasi transfer bisa diinformasikan melalui chat.</p>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop