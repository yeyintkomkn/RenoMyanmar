
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
        <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" width="100%" alt="photo" class="img-fluid">

    <section>
        <div class="container">
            <div class="row mt-top">
                <div class="col-md-9 well">
                   @foreach($all_blogs as $data)
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$data['photo_url']}}" alt="Photo" class="img-fluid img-thumbnail" style="width:100%;height: 150px;">
                        </div>
                        <div class="col-md-9">
                            <div class="">
                                <h3>
                                    <a href="{{url('blog_detail/'.$data['id'])}}">
                                        {{$data['title']}}
                                    </a>
                                </h3>
                                <h6>
                                    {{--<span class="text-muted"><i class="far fa-clock"></i> 12:20:60s |</span>--}}

                                    <span class="text-muted"><i class="far fa-calendar-alt"></i> {{$data['date']}}</span>
                                </h6>

                                <p>
{{--                                    {{substr($data['description'],0,100)}}--}}
                                    {{--<a href="{{url('blog_detail/'.$data['id'])}}">more detail...</a>--}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    {{$paginate->links()}}

                    {{--<nav aria-label="Page navigation example">--}}
                        {{--<ul class="pagination pagination-lg justify-content-center">--}}
                            {{--<li class="page-item"><a class="page-link" href="#">&larr;</a></li>--}}
                            {{--<li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">...</a></li>--}}
                            {{--<li class="page-item"><a class="page-link" href="#">&rarr;</a></li>--}}
                        {{--</ul>--}}
                    {{--</nav>--}}
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

                        </div>
                    </div>
                    {{--<div class="well widge">--}}
                        {{--<div class="well-body">--}}
                            @foreach($area_four_ads as $data)
                                <div style="padding: 5px;">
                                    <a href="={{$data['link']}}" target="_blank">
                                        <img src="{{$data->photo_url}}" alt="" class="img-responsive" width="100%">
                                    </a>
                                </div>
                            @endforeach
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

@endsection
