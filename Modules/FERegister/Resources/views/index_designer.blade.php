@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Persyaratan</h1>
    </div>
    <div style="font-size: 18px; text-align: center;">
        <span>Memiliki Kemampuan Desain Grafis</span><br>
        <span>Memiliki Kemampuan dan Pengetahuan Tentang Produk Undangan</span><br>
        <span>Bisa Menggunakan Adobe Illustrator / Corel Draw / Photoshop</span><br>
        <span>*File yang diserahkan merupakan file olahan bukan berbentuk gambar</span>
    </div>

    <div class="tt-page__name text-center">
        <h1>Daftar Desainer</h1>
    </div>

    <div class="tt-login">
        <div class="tt-login__title">
            <p>Informasi Pribadi</p>
        </div>
        <form method="POST" action="{{ route('frontend.register.store') }}">
            {{ csrf_field() }}
            <div class="tt-form">
                <div class="tt-form__form">
                    <label>
                        <div class="row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <div class="col-md-3"><span class="ttg__required">Nama Depan:</span></div>
                            <div class="col-md-9">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus class="form-control"
                                       placeholder="Masukkan nama depan">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <div class="col-md-3"><span class="ttg__required">Nama Belakang:</span></div>
                            <div class="col-md-9">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus class="form-control"
                                       placeholder="Masukkan nama belakang">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="row">
                            <div class="col-md-3"><span class="ttg__required">Email:</span></div>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                                       placeholder="Masukkan email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-3"><span class="ttg__required">Password:</span></div>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password" required
                                       placeholder="Masukkan password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="row">
                            <div class="col-md-3"><span class="ttg__required">Konfirmasi Password:</span></div>
                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                placeholder="Masukkan konfirmasi password">
                            </div>
                        </div>
                    </label>
                    <input type="hidden" class="form-control" name="role" value="2" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 offset-md-3 ttg-mt--40">
                    <button type="submit" class="btn">Buat</button>
                    <div class="tt-login__tostore">
                        <span>atau</span>
                        <a href="{{url('/')}}">Kembali ke toko</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop
