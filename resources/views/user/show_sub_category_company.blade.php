
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')
@section('css')

    <style>
        .category-detail h4 a{
            font-size: 15px!important;
        }
    </style>

@endsection
@section('content')
    <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" alt="Just a minute" class="img-responsive" id="hidden-xs-type">

    <!-- Jobs By Category Start-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="row">
                        <div class="main-heading">
                            <h2>Browse Jobs By <span>Category</span></h2>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($sub_categories as $category)
                            <div class="col-md-3 col-sm-6">
                                <div class="category-box" data-aos="fade-up">
                                    <div class="category-desc">
                                        <!-- <div class="category-icon">
                                            <i class="icon-bargraph" aria-hidden="true"></i>
                                            <i class="icon-bargraph abs-icon" aria-hidden="true"></i>
                                        </div> -->
                                        <span class="{{$category->logo}} fa-5x"></span>
                                        <div class="category-detail category-desc-text">
                                            <h4> <a href="{{url('category_company/'.$category->id)}}">{{$category->category_name}}</a></h4>
                                            <p>{{$category->count->count}} Companies</p>
                                            <a href="{{url('category_company/'.$category->id)}}">More Detail <span class="fa fa-angle-double-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>



                    <div class="row">
                        {{$sub_categories->links()}}

                    </div>
                </div>
                <div class="col-md-3 the_advertisting">
                    <br>
                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>

                    <div>
                        <img src="img/banner.jpg" alt="" class="img-responsive">
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- Job By Category End-->


@endsection


