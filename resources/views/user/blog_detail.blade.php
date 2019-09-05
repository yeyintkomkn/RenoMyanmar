
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
        <!-- This is online banner radom photo -->
        <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" width="100%"  alt="photo" class="img-fluid">


    <section>
        <div class="container">
            <div class="row mt-top">
                <div class="col-md-9 well">
                    <div class="row  well-body">
                        <img src="{{$blog_data['photo_url']}}" width="100%" height="500px" alt="photo" class="img-fluid">
                    </div>
                    <h2>
                        {{$blog_data['title']}}
                    </h2>
                    <h6>
                        {{--<span class="text-muted"><i class="far fa-clock"></i> 12:20:60s |</span>--}}

                        <span class="text-muted"><i class="far fa-calendar-alt"></i> {{$blog_data['date']}}</span>
                    </h6>
                    <hr>
                    <p>
                        {!!$blog_data['description']!!}
                    </p>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#"><i class="fab fa-twitter fa-2x"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#"><i class="fab fa-google-plus fa-2x"></i></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <div class="well widge">
                        <div class="well-body">
                            @foreach($latest_blog as $data)
                            <h5>
                                <a href="{{url('blog_detail/'.$data['id'])}}"><i class="fas fa-chevron-circle-right"></i> {{$data['title']}}</a>
                            </h5>
                            <hr>
                            @endforeach



                            {{--<nav aria-label="Page navigation example">--}}
                                {{--<ul class="pagination">--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">&larr;</a></li>--}}
                                    {{--<li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">...</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">&rarr;</a></li>--}}
                                {{--</ul>--}}
                            {{--</nav>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
