@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>My Account</h1>
    </div>

    <div class="tt-my-account">
        <div class="tt-my-account__tabs tt-tabs tt-layout__mobile-full" data-tt-type="vertical">
            <div class="tt-tabs__head">
                <div class="tt-tabs__slider">
                    <div class="tt-tabs__btn"><span>Beranda</span></div>
                    <div class="tt-tabs__btn" data-active="true"><span>Pengaturan Akun</span></div>
                    <div class="tt-tabs__btn"><span>Keluar</span></div>
                </div>
                <div class="tt-tabs__btn-prev"></div>
                <div class="tt-tabs__btn-next"></div>
                <div class="tt-tabs__border"></div>
            </div>
            <div class="tt-tabs__body tt-tabs-my-account">
                <div>
                    <span>Beranda <i class="icon-down-open"></i></span>
                    <div class="tt-tabs__content">
                        <p class="ttg-mb--20">Selamat datang di Undangan Qu. Terima kasih telah menjadi bagian dari kami!</p>
                    </div>
                </div>
                <div>
                    <span>Detail Akun <i class="icon-down-open"></i></span>
                    <div class="tt-tabs__content">
                        <form action="{{ @$data['user'] ? route('backend.user.update', ['id' => @$data['user']->id]) : route('backend.user.store') }}" enctype="multipart/form-data" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="tt-form">
                                <div class="tt-form__form">
                                    <label>
                                        <div class="row">
                                            <div class="col-md-3"><span
                                                        class="ttg__required">Nama Depan:</span></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control colorize-theme6-bg"
                                                       value="{{Auth::user()->first_name}}" placeholder="Masukkan nama depan" >
                                            </div>
                                        </div>
                                    </label>
                                    <label>
                                        <div class="row">
                                            <div class="col-md-3"><span
                                                        class="ttg__required">Last Name:</span></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control colorize-theme6-bg"
                                                       value="{{Auth::user()->last_name}}" placeholder="Masukkan nama belakang">
                                            </div>
                                        </div>
                                    </label>
                                    <label>
                                        <div class="row">
                                            <div class="col-md-3"><span class="ttg__required">Email:</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control colorize-theme6-bg"
                                                       value="{{Auth::user()->email}}" placeholder="Masukkan nama email">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="tt-tabs-my-account__form ttg-mt--40">
                                <div class="tt-tabs-my-account__form_title">Ubah Password</div>
                                <p>Password</p>
                                <input type="text" class="form-control"
                                       placeholder="Masukkan Password">
                                <p>Konfirmasi Password</p>
                                <input type="text" class="form-control"
                                       placeholder="Masukkan Konfirmasi Password">
                            </div>
                            <button class="btn ttg-mt--40">Save Changes</button>
                        </form>
                    </div>
                </div>
                <div>
                    <span>Keluar <i class="icon-down-open"></i></span>
                    <div class="tt-tabs__content">
                        <h4>Keluar</h4>
                        <a href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop
