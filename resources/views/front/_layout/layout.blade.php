<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title  -->
        <title>@yield('seo_title') | Bigshop</title>

        <!-- Favicon  -->
        <link rel="icon" href="{{url('/themes/front/img/core-img/favicon.ico')}}">

        <!-- Style CSS -->
        <link rel="stylesheet" href="{{url('/themes/front/style.css')}}">
        <link href="{{url('/themes/front/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
        @stack('head_css')
        @stack('head_recaptcha')
    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="spinner-grow" role="status">
                <span class="sr-only">@lang('Loading')...</span>
            </div>
        </div>

        <!-- Header Area -->
        <header class="header_area">
            @include('front._layout.navigation')
        </header>
        <!-- Header Area End -->

        @yield('content')

        <!-- Footer Area -->
        @include('front._layout.footer')
        <!-- Footer Area -->

        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="{{url('/themes/front/js/jquery.min.js')}}"></script>
        <script src="{{url('/themes/front/js/popper.min.js')}}"></script>
        <script src="{{url('/themes/front/js/bootstrap.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery.easing.min.js')}}"></script>
        <script src="{{url('/themes/front/js/default/classy-nav.min.js')}}"></script>
        <script src="{{url('/themes/front/js/owl.carousel.min.js')}}"></script>
        <script src="{{url('/themes/front/js/default/scrollup.js')}}"></script>
        <script src="{{url('/themes/front/js/default/sticky.js')}}"></script>
        <script src="{{url('/themes/front/js/waypoints.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery.countdown.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery.counterup.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery-ui.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jarallax.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jarallax-video.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{url('/themes/front/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{url('/themes/front/js/wow.min.js')}}"></script>
        <script src="{{url('/themes/front/js/default/active.js')}}"></script>
        <script src="{{url('/themes/front/plugins/toastr/toastr.min.js')}}" type="text/javascript"></script>
        @stack('footer_javascript')
    </body>

</html>