<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.partials.head')
</head>


<body class="skin-default fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Undangan Admin</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

@include('backend.partials.top_bar')
<!-- Start right Content here -->
    @if(Auth::check())
        @if(Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
            @include('backend.partials.left_side')
        @endif
    @endif

    <div class="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div> <!-- container -->
    </div> <!-- content -->
</div>
<!-- footer content -->
<footer class="footer">
    © 2018 Ovie Inten Pertiwi - Politeknik Negeri Pontianak
</footer>
<!-- /footer content -->
</div>


<script src="{{asset('b/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('b/assets/node_modules/popper/popper.min.js')}}"></script>
<script src="{{asset('b/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('b/assets/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('b/assets/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('b/assets/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('b/assets/dist/js/custom.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="{{asset('b/assets/node_modules/raphael/raphael-min.js')}}"></script>
<script src="{{asset('b/assets/node_modules/morrisjs/morris.min.js')}}"></script>
<script src="{{asset('b/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Popup message jquery -->
<script src="{{asset('b/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
<!-- Chart JS -->
<script src="{{asset('b/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{ asset('b/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('b/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('b/assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('b/assets/js/jquery.app.js') }}"></script>
<script src="{{ asset('plugins/sweet-alert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('b/assets/js/CooemApp.js') }}"></script>
@yield('script')

</body>
</html>