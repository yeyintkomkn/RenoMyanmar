
<!doctype html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>Reno Myanmar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{url('css/frontend_css/plug_in.css')}}">

    <link rel="shortcut icon" href="{{asset('images/frontend_images/reno_myanmar.png')}}">
    <!-- Custom style -->

    <link href="{{url('css/frontend_css/style.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{url('css/frontend_css/green_style.css')}}">
    {{--<link rel="stylesheet" href="font/css/all.min.css">--}}
    <link rel="stylesheet" href="{{url('css/frontend_css/Montserrat.css')}}">
    <link rel="stylesheet" href="{{url('css/frontend_css/Raleway.css')}}">
    <link rel="stylesheet" href="{{url('css/frontend_css/Josefin.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{url('fonts/frontend_fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('fancybox-master/dist/jquery.fancybox.min.css')}}">
    <script src='https://www.google.com/recaptcha/api.js'></script>

    @yield('css')

</head>
<body>
@include('layouts.userLayout.user_header')

@yield('content')


@include('layouts.userLayout.user_footer')


{{--<script src="code.jquery.com/jquery-3.2.1.min.js"></script>--}}

<!-- Scripts
================================================== -->
{{--<script type="text/javascript" src="{{url('js/frontend_js/frontend_js/jquery.min.js')}}"></script>--}}
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{url('js/frontend_js/viewportchecker.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/bootsnav.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/datedropper.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/dropzone.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/loader.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/frontend_js/gmap3.min.js')}}"></script>

<!-- Custom Js -->

<script src="{{url('js/frontend_js/custom.js')}}"></script>

<script src="{{url('fancybox-master/dist/jquery.fancybox.min.js')}}"></script>
<script src="{{url('js/frontend_js/jQuery.style.switcher.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#styleOptions').styleSwitcher();
    });
</script>
<script>
    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }

    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
    }
</script>
@yield('js')


{{--</div>--}}
</body>
</html>