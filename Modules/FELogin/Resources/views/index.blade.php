@extends('frontend.single_layout')

@section('meta')

@stop

@section('hero_title', $heroFill['name'])

@section('content')
    <div class="tt-page__name text-center">
        <h1>Login</h1>
    </div>

    <div class="tt-login">
        <form action="{{route('frontend.login')}}" method="post">
            {{csrf_field()}}
            <div class="tt-form">
                <div class="tt-form__form">
                    <label>
                        <div class="row">
                            <div class="col-md-3"><span class="ttg__required{{ $errors->has('email') ? ' has-error' : '' }}">Email:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control"
                                       placeholder="Enter please your email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="row">
                            <div class="col-md-3"><span class="ttg__required{{ $errors->has('password') ? ' has-error' : '' }}">Password:</span></div>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control"
                                       placeholder="Enter please your password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </label>
                </div>
            </div>
            <div class="row ttg-mt--40">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn">Login</button>
                </div>
            </div>
            <div class="row ttg-mt--40">
                <div class="col-md-5 col-sm-6 offset-md-3">
                    <label class="tt-checkbox">
                        <input type="checkbox">
                        <span></span>
                        <p>Remember me</p>
                    </label>
                </div>
                <div class="col-md-4 col-sm-6 text-right"><a href="#">Lost your password?</a></div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad89720ce3b11d4"></script>
@stop

