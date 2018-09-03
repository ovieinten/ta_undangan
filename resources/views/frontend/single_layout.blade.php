<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials.head')
    @yield('meta')
    @yield('styling')
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b4ee711df040c3e9e0bad06/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body id="theme">
<header>
    @include('frontend.partials.preloader')
    <div class="tt-header tt-header--build-03 tt-header--style-05 tt-header--sticky">
        @include('frontend.partials.header')

        @include('frontend.partials.nav')
    </div>

</header>
<!-- START MAIN CONTENT DESIGN AREA -->
<main>
    <div class="tt-layout tt-sticky-block__parent">
        <div class="tt-layout__content">
            <div class="container">
            @include('frontend.partials.hero', ['data' => @$heroFill])
            <!-- START POST CONTENT DESIGN AREA -->
                @yield('content')

            </div>
        </div>
    </div>
</main>
@include('frontend.partials.footer')

@include('frontend.partials.script')
@yield('scripting')
</body>

</html>