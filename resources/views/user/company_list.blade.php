
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')

@section('content')
    <img src="{{asset('images/frontend_images/page_banner.jpg')}}" alt="" class="img-responsive">
    <section id="companies-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{--start loop--}}
                    @if(count($companies)==0)
                        <h2>No Search Result!...</h2>
                        @endif
                    @foreach($companies as $company)
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

                </div>
                <div class="col-md-4 the_advertisting">
                    @foreach($ads as $data)
                    <div style="padding: 5px;">
                        <a href="={{$data['link']}}" target="_blank">
                            <img src="{{$data->photo_url}}" alt="" class="img-responsive" width="100%">
                        </a>
                    </div>
                   @endforeach
                </div>
            </div>
            <div class="row">
                {{$paginate->links()}}
            </div>
            {{--<div class="row">--}}
                {{--<ul class="pagination">--}}
                    {{--<li><a href="#">&laquo;</a></li>--}}
                    {{--<li class="active"><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#">&raquo;</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        </div>
    </section>
@endsection