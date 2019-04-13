
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')


@section('css')

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <style>
        a{
            text-decoration: none!important;
        }
        .widge a{
            color: #000;
            text-decoration: none;
        }
        .widge a:hover{
            opacity: 0.8;
        }
        .list-inline a{
            color: #777;
        }
        .list-inline a:hover{
            opacity: 0.8;
        }
        .well{
            background: #fff!important;
        }
        .mt-top{
            position: relative;
            top: -100px!important;
        }

    </style>
@endsection
@section('content')
    {{--<section>--}}
    <!-- This is online banner radom photo -->
    <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" width="100%"  alt="photo" class="img-fluid">
    {{--</section>--}}

    <section>
        <div class="container">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            About Us
                        </h2>
                        <p>
                            {{$site_profile->about_us}}
                        </p>

                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('images/frontend_images/site_profile/home_bg_img.jpg')}}" alt="" class="img-responsive">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 col-md-push-6">
                        <h2>
                            Our Vision and Mision
                        </h2>
                        <p>
                            {{$site_profile->vision_and_mission}}
                        </p>
                    </div>
                    <div class="col-md-6 col-md-pull-6">
                        <img src="{{asset('images/frontend_images/site_profile/home_bg_img.jpg')}}" alt="" class="img-responsive">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            What we do
                        </h3>
                        <p>
                            {{$site_profile->what_we_do}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
