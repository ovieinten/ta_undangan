
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('b/assets/images/favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
            <!-- App css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/animate/animate.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/css-hamburgers/hamburgers.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/animsition/css/animsition.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/select2/select2.min.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/vendor/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/css/util.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('b/assets/css/main.css') }}">
        <script src="{{ asset('b/assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="account-pages">
    <div class="limiter">
        <div class="container-login100" style="background-image: url({{ asset('b/assets/images/bg-01.jpg')}});">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="{{route('login')}}" method="post">
                    {{csrf_field()}}
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>

                    <div class="wrap-input100 validate-input{{ $errors->has('email') ? ' has-error' : '' }} m-b-23" data-validate = "Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#x2709;"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input{{ $errors->has('password') ? ' has-error' : '' }}" data-validate ="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>                        
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="text-right p-t-8 p-b-31">
                        <a href="#">
                            Forgot password?
                        </a>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>

        <!-- jQuery  -->
    <script src="{{ asset('b/assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('b/assets/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('b/assets/js/main.js') }}"></script>
        <!-- App js -->
    <script src="{{ asset('b/assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('b/assets/js/jquery.app.js') }}"></script>
<!-- <script src="{{ asset('b/assets/js/CooemApp.js') }}"></script> -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">

    </script>


    @include('sweet::alert')
    </body>
</html>