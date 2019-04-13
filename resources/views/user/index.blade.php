
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')
@section('css')
    <style>
        .MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
        .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
        .MultiCarousel .MultiCarousel-inner .item { float: left;}
        .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:10px; background:#f1f1f1; color:#666;}
        .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
        .MultiCarousel .leftLst { left:0; }
        .MultiCarousel .rightLst { right:0; }

        .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
    </style>
    @endsection
@section('content')
    <!--main-container-part-->
    <div class="clearfix"></div>
    <!-- Main Banner Section Start -->
    <div class="simple-banner new-banner" style="background-image:url({{asset('images/frontend_images/banner.jpg')}});background-attachment: fixed;">
        <!-- Wrapper for carousel items -->
        <div class="container">
            <div class="simple-banner-caption">
                <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 banner-text">
                    <h3>More than 20,000 job in available</h3>
                    <h1>Reno <span>Myanmar</span></h1>
                </div>
            </div>
            <div class="text-center">


                <a href="javascript:void(0)" data-toggle="modal" data-target="#signup_2" class="btn btn-success hidden-sm hidden-xs">Request a quote</a>
            </div>
            <div class="text-center">


                <a href="javascript:void(0)" data-toggle="modal" data-target="#signup_2" class="hidden-lg hidden-md label label-success" style="padding: 10px;border-radius: 0;font-size: 12px;">&nbsp;Request a quote</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Main Banner Section End -->

    <!-- Search Company start -->
    <section class="bottom-search-form">
        <div class="container">
            <form action="{{url('search_company')}}" method="post" class="bt-form">
                {{csrf_field()}}
                <div class="col-md-3 col-sm-6">
                    <input type="text" name="company_name" class="form-control" placeholder="Skills, Designations, Keyword">
                </div>
                <div class="col-md-3 col-sm-6">
                    <select name="main_category" class="form-control">
                        <option value="">Select Category</option>
                       @foreach($main_categories as $main_category)
                           <option value="{{$main_category->id}}">{{$main_category->category_name}}</option>
                           @endforeach

                    </select>
                </div>
                <div class="col-md-3 col-sm-6">
                    <select name="location" class="form-control">
                        <option value="">Select Location</option>
                        <option value="Yangon">Yangon</option>
                        <option value="Mandalay">Mandalay</option>
                        <option value="Other">Other</option>

                    </select>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success request_a_quote"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Bottom Search Form Section End -->
    {{--Ads--}}
    <section>
        <div class="container">


            <div class="row">
                <div class="col-md-12">
                    {{--<div class="carousel slide multi-item-carousel" id="theCarousel">--}}
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                        {{--<div class="carousel-inner">--}}
                        <div class="MultiCarousel-inner">
                            {{--<div class="item active">--}}
                                @foreach($area_one_ads as $data)
                                <div class="item">
                                    <div>
                                        <a href="{{$data['link']}}" target="_blank">
                                            <img src="{{$data->photo_url}}" class="img-responsive" width="100%" style="height: 200px;">
                                        </a>
                                    </div>
                                </div>
                                    @endforeach
                            {{--</div>--}}
                        </div>
                        <button class="btn btn-primary leftLst"><</button>
                        <button class="btn btn-primary rightLst">></button>
                        {{--<a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>--}}
                        {{--<a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>--}}
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Jobs By Category Start-->
    <section>
        <div class="container">

            <div class="row">
                <div class="main-heading">
                    <h2>Browse Jobs By <span>Category</span></h2>
                </div>
            </div>

            <div class="row">
                    {{--start loop--}}
                @for($i=0;$i<8;$i++)
                    <div style="display: none;">{{$category=$sub_categories[$i]}}</div>
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
                    @endfor

                {{--end loop--}}


                <div class="col-md-12 text-center">
                    <a href="{{url('sub_category_company')}}" class="btn btn-success">View All Job <i class="fa fa-arrow-circle-right"></i></a>
                </div>

            </div>

        </div>
    </section>
    <!-- Job By Category End-->

    <!-- video section Start -->
    {{--<section class="video-sec dark" id="video" style="background-image:url(assets/img/banner-10.jpg);">--}}
    <section class="video-sec dark" id="video">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>Best For Your Projects</p>
                    <h2>Watch Our <span>video</span></h2>
                </div>
            </div>
            <!--/row-->
            <div class="video-part">
                <a href="#" data-toggle="modal" data-target="#my-video" class="video-btn"><i class="fa fa-play"></i></a>
                {{--<iframe style="width:100%;" src="https://www.youtube.com/embed/Cz43E6wngec" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
            </div>
        </div>
    </section>
    <!-- video section Start -->

    <!-- Admi Blog Post Start -->
    <section class="wp-process">
        <div class="container">

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="main-heading">
                        {{--<p>Lat</p>--}}
                        <h2>Latest <span>News</span></h2>
                    </div>
                </div>
            </div>
            <!--/row-->

            <div class="row">
                @foreach($latest_blog as $data)
                <div class="col-md-4 col-sm-4">
                    <div class="popular-jobs-container">
                        <div class="popular-jobs-box">
                            <div class="popular-jobs-box">
                                <div style="margin-top: -60px">
                                    <img style="width:100%;height: 200px;" src="{{$data['photo_url']}}" class="img">
                                </div>
                                <div class="popular-jobs-box-detail">
                                    <h4>Google Inc</h4>
                                    <span class="desination">{{$data['title']}}</span>
                                </div>
                            </div>

                        </div>
                        <a href="{{url('blog_detail/'.$data['id'])}}" class="btn btn-popular-jobs bt-1">View Detail</a>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- More -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="text-center">
                        <a href="{{url('blog')}}" class="btn btn-primary">Load More</a>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- start testimonial section -->
    <div class="clearfix"></div>
    <section class="testimonial" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="main-heading">
                    <p>What Say Our Client</p>
                    <h2>Our Success <span>Stories</span></h2>
                </div>
            </div>
            <!--/row-->

            <div class="row">
                <div id="client-testimonial-slider" class="owl-carousel">
                    @foreach($admin_feedback as $feedback)
                        {{--start loop--}}
                        <div class="client-testimonial">
                            <div class="pic">
                                <img src="{{asset('images/frontend_images/admin_feedback/'.$feedback->picture)}}" alt="">
                            </div>
                            <p class="client-description">
                                {{$feedback->description}}
                            </p>
                            <h3 class="client-testimonial-title">{{$feedback->name}}</h3>
                            {{--<ul class="client-testimonial-rating">--}}
                            {{--<li class="fa fa-star-o"></li>--}}
                            {{--<li class="fa fa-star-o"></li>--}}
                            {{--<li class="fa fa-star"></li>--}}
                            {{--</ul>--}}
                        </div>
                        {{--end loop--}}
                     @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial section End -->

    <!-- ========== Begin: Brows job Category ===============  -->
    <section class="brows-job-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Top 10 Companies</h2>
                </div>
            </div>
            <!--/.row-->

            <div class="row">
                <div class="col-md-8">
                    @foreach($top_companies as $company)
                        <div class="item-click">
                            <article>
                                <div class="brows-job-list">
                                    <div class="col-md-1 col-sm-2 small-padding">
                                        <div class="brows-job-company-img">
                                            <a href="{{url('company_profile/'.$company->id)}}"><img src="{{url('upload/company_logo/'.$company->photo)}}" class="img-responsive" alt="" /></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-5">
                                        <div class="brows-job-position">
                                            <a href="{{url('company_profile/'.$company->id)}}"><h3>{{$company->company_name}}</h3></a>
                                            <p>
                                                <span>@if(isset($company->categories[0]['main_category_name'])){{$company->categories[0]['main_category_name']}} @endif</span>
                                                <span class="brows-job-sallery"><i class="fa fa-phone"></i>{{$company->phone}}</span>
                                                {{--<span class="job-type cl-success bg-trans-success">Contact Us</span>--}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-3">
                                        <div class="brows-job-location">
                                            <p><i class="fa fa-map-marker"></i>{{$company->address}}</p>
                                            <span class="label label-success">Advance Ads</span>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-2">
                                        <div class="brows-job-link">
                                            <a href="{{url('company_profile/'.$company->id)}}" class="btn btn-default">More Detail</a>
                                        </div>

                                    </div>

                                </div>
                            </article>
                        </div>
                    @endforeach

                    {{--end loop    --}}


                </div>
                <div class="col-md-4 the_advertisting">
                    @foreach($area_two_ads as $ads)
                    <div>
                        <a href="{{$ads['link']}}" target="_blank">
                            <img src="{{$ads['photo_url']}}" alt="" class="img-responsive" width="100%">
                        </a>
                    </div>
                        <br>
                     @endforeach

                </div>
            </div>

            <div class="row">
                {{$top_paginate->links()}}
                {{--<ul class="pagination">--}}
                    {{--<li><a href="#">&laquo;</a></li>--}}
                    {{--<li class="active"><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#">&raquo;</a></li>--}}
                {{--</ul>--}}
            </div>

        </div>
    </section>
    <!-- ========== Begin: Brows job Category End ===============  -->

    <!-- Download app Section Start -->
    <div class="clearfix"></div>
    <section class="download-app" style="background-image:url({{url('images/frontend_images/home_bg_img.jpg')}});background-size: cover;">
        <div class="container">
            <div class="col-md-5 col-sm-5 hidden-xs">
                <img src="{{url('images/frontend_images/gh_1.png')}}" alt="iphone" class="img-responsive" />
            </div>
            <div class="col-md-7 col-sm-7">
                <div class="app-content">
                    <h2>Download Our Best Apps</h2>
                    <h4>Best oppertunity in your hand</h4>
                    <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus, id tincidunt nisi porta sit amet. Suspendisse et sapien varius, pellentesque dui non, semper orci. Curabitur blandit, diam ut ornare ultricies.</p>
                    <a href="{{$site_profile->android}}" target="_blank" class="btn call-btn"><i class="fa fa-apple"></i>Download</a>
                    <a href="{{$site_profile->ios}}" target="_blank" class="btn call-btn"><i class="fa fa-android"></i>Download</a>
                </div>
            </div>
            <!--/row-->
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Download app Section End -->
    <!--end-main-container-part-->




    <!-- =======================Request a quote======================== -->
    <div class="modal fade" id="signup_2" tabindex="-1" role="dialog" aria-labelledby="request_a_quote_2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="tab" role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" style="width: 100%!important;"><a href="#request_a_quote" role="tab" data-toggle="tab">Request A Quote</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content" id="request_a_quote_2">
                            <div role="tabpanel" class="tab-pane fade in active" id="request_a_quote">
                                <img src="{{asset('images/frontend_image/reno_myanmar.png')}}" class="img-responsive" alt="" />
                                <div class="subscribe wow fadeInUp">
                                    <form action="{{url('preview')}}" enctype="multipart/form-data" class="form-inline" method="post">
                                        {{csrf_field()}}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text"  name="username" class="form-control" placeholder="Username*" required="">
                                                <input type="email"  name="email" class="form-control" placeholder="Email*" required="">
                                                <input type="tel" name="phone" class="form-control"  placeholder="Phone*" required="">
                                                <input type="text" name="address" class="form-control"  placeholder="Address*" required="">
                                                <select name="budget_range" id="" class="form-control">
                                                    <option value="--no-select--">--Budget Range*--</option>
                                                    <option value="50laks"> 50 Lakhs </option>
                                                    <option value="100laks">100 Lakhs </option>
                                                    <option value="200laks">200 Lakhs </option>
                                                    <option value="300laks">300 Lakhs </option>
                                                    <option value="more300laks">More than 300 Lakhs </option>
                                                </select>
                                                <h5>
                                                    Service Type
                                                </h5>
                                                @foreach($main_categories as $data)

                                                    <input type="checkbox" name="service_type[]" id="construction{{$data->id}}" value="{{$data->id}}"> <label for="construction{{$data->id}}"> {{$data->category_name}}</label> &nbsp;

                                                @endforeach
                                                <hr>

                                                <!-- ===================== -->
                                                <h5>
                                                    Project Type
                                                </h5>
                                                @foreach($keywords as $data)

                                                    <input type="checkbox" name="project_type[]" value="{{$data->id}}" id="residential{{$data->id}}"> <label for="residential{{$data->id}}"> {{$data->name}}</label> &nbsp;&nbsp;
                                                    <br>
                                                @endforeach
                                                <hr>
                                                <h5>
                                                    Expected Project Start Date*
                                                </h5>

                                                <input type="date" name="start_date" class="form-control" required>
                                                <hr>

                                                <input type="text" name="current_situation" placeholder="Current Situation*" class="form-control" required>

                                                <input type="text" name="description" placeholder="Brief Description*" class="form-control" required>
                                                <!-- =================== -->
                                                <label for="support" class="btn btn-dark btn-xs btn-block"><i class="fa fa-file-pdf-o fa-lg"></i> PDF Upload</label>
                                                <input type="file" name="data_file" style="visibility: hidden;" id="support">
                                                <div class="text-center">
                                                    <input type="checkbox" required id="read_and_agree"> <label for="read_and_agree">I have read and agree Team and Privicy Policy.</label>
                                                </div>
                                                <div class="center">
                                                    <input type="submit" id="login-btn" class="submit-btn" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');
            var itemWidth = "";

            $('.leftLst, .rightLst').click(function () {
                var condition = $(this).hasClass("leftLst");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });

            ResCarouselSize();




            $(window).resize(function () {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function () {
                    id = id + 1;
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    $(this).parent().attr("id", "MultiCarousel" + id);


                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    }
                    else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                    $(this).find(itemClass).each(function () {
                        $(this).outerWidth(itemWidth);
                    });

                    $(".leftLst").addClass("over");
                    $(".rightLst").removeClass("over");

                });
            }


            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftLst');
                var rightBtn = ('.rightLst');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");

                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                }
                else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");

                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }

            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }

        });
    </script>
    <script>
        @if(Session::has('error_msg'))
           $('#signup').modal('show');
        @endif
        @if(Session::has('success_msg'))
            $('#signup').modal('show');
        @endif
        @if(Session::has('reg_error_msg'))
            $('#signup').modal('show');//show reg form
        @endif

    </script>
    @endsection