
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')

@section('content')
    <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" alt="Just a minute" class="img-responsive" id="hidden-xs-type">


    <!-- Hidden xs in company name -->
    <section class="hidden-xs">
        <div class="container">
            <div class="row position-double">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row position-double-2">
                        <div class="col-sm-4 col-md-2 border-company-logo">
                            <img src="{{asset('upload/company_logo/'.$company_info->photo)}}" alt="" class="img-responsive">
                        </div>
                        <div class="col-sm-8 col-md-10 border-company-logo-2">
                            <h4>
                               {{$company_info->company_name}}
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="companies-type list-unstyled">
                                        <li><i class="fa fa-user"></i><b>Company Type:</b>
                                            @if(count($company_info->categories)!=0)
                                                {{$company_info->categories[0]['main_category_name']}}
                                                @endif

                                        </li>
                                        <li><i class="fa fa-hand-o-right"></i><b> Industry:</b>
                                            @if(count($company_info->categories)!=0))
                                                @foreach($company_info->categories as $category)
                                                    {{$category['sub_category_name']}},
                                                @endforeach
                                            @endif

                                        </li>
                                        <li><i class="fa fa-hand-o-right"></i><b> Email:</b>  <a href="mailto:{{$company_info->company_name}}" data-tooptip='web-link' title="Click! Now join.">{{$company_info->email}}</a></li>

                                        <li><i class="fa fa-hand-o-right"></i><b> Phone:</b>  <a href="tel:{{$company_info->phone}}" data-tooptip='web-link' title="Click! Now Call.">{{$company_info->phone}}</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="companies-type list-unstyled list-inline">
                                        <li><i class="fa fa-map-marker"></i> <b> Address:</b> {{$company_info->address}} </li>
                                        <br><br>
                                        <li>
                                            <a href="{{$company_info->facebook_url}}" target="_blank" data-tooptip='web-link' title="Facebook"><i class="fa fa-facebook-square fa-2x"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{$company_info->website_url}}" target="_blank" data-tooptip='web-link' title="Website link or Domain name"><i class="fa fa-wordpress fa-2x"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row job-and-carrier-border">
                        <div class="col-md-12 job-and-carrier">
                            <div>
                                <h5>
                                    {{$company_info->company_name}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <!-- Hidden xs in company name End-->


    <!-- Hidden lg/md/sm in company name -->
    <section>
        <div class="hidden-lg-type">
            <div class="container hidden-lg hidden-md hidden-sm">

                <div class="row">
                    <div class="col-xs-4 ml-border">
                        <img src="{{asset('images/frontend_images/gh.png')}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-xs-8">
                        <h3>Green Hackers</h3>
                        <div class="about-of-company">
                            <h5>About us</h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. At minus, autem veniam totam porro quo temporibus adipisci.
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="companies-type list-unstyled">
                            <li><i class="fa fa-user"></i><b> Company Type:</b>
                                @if(count($company_info->categories)!=0)
                                    {{$company_info->categories[0]['main_category_name']}}
                                @endif
                            </li>
                            <li><i class="fa fa-hand-o-right"></i><b> Industry:</b>
                                @if(count($company_info->categories)!=0)
                                    @foreach($company_info->categories as $category)
                                        {{$category['sub_category_name']}},
                                    @endforeach
                                @endif

                            </li>
                            <li><i class="fa fa-hand-o-right"></i><b> Phone:</b>  <a href="tel:{{$company_info->phone}}" data-tooptip='web-link' title="Click! Now Call.">{{$company_info->phone}}</a></li>
                            <li><i class="fa fa-hand-o-right"></i><b> Email:</b>  <a href="mailto:{{$company_info->email}}" data-tooptip='web-link' title="Click! Now join.">{{$company_info->email}}</a></li>

                        </ul>
                    </div>

                </div>
                <br><br>
            </div>
        </div>
    </section>
    <!-- Hidden lg/md/sm in company name end-->

    {{--****************start company photo--}}
    @if($company_info->type=="paid")
    {{--start project--}}
    <section id="mt-10-company-image">
        <div class="container">
            <div class="row">
                @for($i=0;$i<8;$i++)
                    <div class="col-md-3 col-sm-6">
                        @if(isset($company_project[$i]))
                            <a href="{{asset('upload/company_project/'.$company_project[$i]->photo)}}" data-fancybox="images" data-caption="{{$company_project[$i]->project_title}}">
                                <img src="{{asset('upload/company_project/'.$company_project[$i]->photo)}}" class="img-responsive" width="100%" style="height:200px;"/>
                            </a>
                            @endif
                        @if(!isset($company_project[$i]))
                                <a href="" data-fancybox="images" data-caption="No Image">
                                    <img src=""  style="height: 200px" class="img-thumbnail img-responsive" width="100%"/>
                                </a>
                            @endif

                    </div>
                    @endfor

            </div>
            <br>

        </div>
    </section>
    {{--****************end company photo--}}
    {{--*******************start company feedback--}}
    <section id="oprator-say-dep">
        <div class="container">
            <div class="row">
                <div id="client-testimonial-slider" class="owl-carousel">
                    {{--start loop--}}
                    @foreach($company_feedbacks as $feedback)
                    <div class="client-testimonial">
                        <div class="pic">
                            <img src="{{url('upload/company_feedback/'.$feedback->picture)}}" alt="">
                        </div>
                        <h3 class="client-testimonial-title">{{$feedback->name}}</h3>
                        <p class="client-description">
                            {{$feedback->description}}
                        </p>
                        <ul class="list-unstyled">
                            {{--<li><a href="#"><i class="fa fa-facebook-square fa-2x"></i></a></li>--}}
                        </ul>

                    </div>
                    {{--end loop--}}
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- what we do -->
    <!-- ================================================== -->

    <section id="what-we-do">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>
                        <span class="fa fa-cogs"></span> What we do
                    </h3>
                    <p>
                        {{$company_info->what_we_do}}
                    </p>
                    <hr>
                    <h3>
                        <span class="fa fa-heart"></span> Why you should join us
                    </h3>
                    <p>
                        {{$company_info->why_join_us}}
                    </p>
                    <hr>
                    <h3>
                        <i class="fa fa-thumbs-o-up"></i> Our vision and mission
                    </h3>
                    <p>
                        {{$company_info->vision_and_mission}}
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </section>


    <section id="body_bg_wh_w_d" style="background-image: url('{{url('images/frontend_images/body_bg_wh_w_d.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>
                        Why should we do
                    </h3>
                    <p>
                        {{$company_info->what_we_do}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    @endif



    <section style="padding-top: 0px;" id="smilier_company_list" class="container">
        {{--start loop--}}
        <h3>Suggest Companies</h3>
        {{--@if(count($suggest_company)==0)--}}
            {{--<h6>Sorry No suggest Companies</h6>--}}
        {{--@endif();--}}
{{--        @if(count($suggest_company)!=0)--}}
        {{--start loop--}}
        @foreach($suggest_company as $company)
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
                                    <span class="job-type cl-success bg-trans-success">Contact Us</span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="brows-job-location">
                                <p><i class="fa fa-map-marker"></i>{{$company->address}}</p>
                                @if($company->type=="paid")
                                <span class="label label-success">Advance Ads</span>
                                    @endif
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
        {{--end loop--}}


        <div class="row">
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </section>

    <!-- Search Company start -->
    <section class="bottom-search-form bottom-search-form-in">
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
@endsection
