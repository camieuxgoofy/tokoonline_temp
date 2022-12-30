<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Furniture - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('themes/ezone/assets/img/favicon.png') }}">

    <!-- Vei -->
    <link rel="stylesheet" href="{{ asset('essence/css/core-style.css') }}">
    <!-- End Vei -->

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/easyzoom.css') }}">
    <script src="{{ asset('themes/ezone/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    @include('themes.ezone.partials.header')

    @yield('content')

    @include('themes.ezone.partials.services')
    @include('themes.ezone.partials.footer')
    @include('themes.ezone.partials.modals')

    <!-- Essence -->
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <!-- <script src="{{ asset('essence/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('essence/js/popper.min.js') }}"></script>
    <script src="{{ asset('essence/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('essence/js/plugins.js') }}"></script>
    <script src="{{ asset('essence/js/classy-nav.min.js') }}"></script>
    <script src="{{ asset('essence/js/active.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <script src="{{ asset('essence/js/map-active.js') }}"></script> -->
    <!-- End Essence -->

    <!-- all js here -->
    <script src=" {{ asset('themes/ezone/assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/popper.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/main.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/app.js') }}"></script>
    <script>
        $(".delete").on("click", function() {
            return confirm("Do you want to remove this?");
        });
    </script>
</body>

</html>