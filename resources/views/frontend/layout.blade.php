<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials.head')
    @yield('meta')
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
    <div class="tt-layout tt-sticky-block__parent tt-layout__fullwidth">
        <div class="tt-layout__content">
            <div class="container">
                    @include('frontend.partials.slider')
                    <div class="tt-home__promobox-03" style="margin-top: 260px;">
                        <div class="container">
                            <div class="row ttg-grid-pdg-btm--sm">
                            </div>
                        </div>
                    </div>
                    @yield('content')

            </div>
        </div>
    </div>
</main>
@include('frontend.partials.footer')

@include('frontend.partials.script')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var parent = document.querySelector('.splitview'),
        topPanel = parent.querySelector('.top'),
        handle = parent.querySelector('.handle'),
        skewHack = 0,
        delta = 0;

    // If the parent has .skewed class, set the skewHack var.
    if (parent.className.indexOf('skewed') != -1) {
        skewHack = 1000;
    }

    parent.addEventListener('mousemove', function(event) {
        // Get the delta between the mouse position and center point.
        delta = (event.clientX - window.innerWidth / 2) * 0.5;

        // Move the handle.
        handle.style.left = event.clientX + delta + 'px';

        // Adjust the top panel width.
        topPanel.style.width = event.clientX + skewHack + delta + 'px';
    });
});
</script>

@yield('scripting')
</body>

</html>