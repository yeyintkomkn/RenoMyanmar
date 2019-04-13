
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lb"> <a href="index.php"> <i class="icon-dashboard"></i> <span class="label label-important">20</span> My Dashboard </a> </li>
                <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>
                <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Project </a> </li>
                <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Feedback</a> </li>
                <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Logout</a> </li>

            </ul>
        </div>
        <!--End-Action boxes-->
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                    <h5>Site Data</h5>
                </div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span8">
                            @if(Session::has('error_msg'))
                                <p class="alert alert-danger">{{ session('error_msg') }}</p>

                            @endif

                            @if(Session::has('success_msg'))
                                <p class="alert alert-success">{{ session('success_msg') }}</p>

                            @endif
                            <form action="{{url('edit_company_profile')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="control-group">
                                    <div class="controls">
                                        <label for="logo_image" class="btn btn-warning">Logo image <i class="icon-picture icon-white"></i></label>
                                        {{--<input type="file" style="visibility: hidden;">--}}
                                        <input name="logo" type="file">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" value="{{$company_profile['company_arr']->company_name}}" placeholder="Company Name*" name="company_name" required class="input-block-level">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <input type="email" value="{{$company_profile['company_arr']->email}}" placeholder="Email*" name="email" required class="input-block-level">
                                </div>
                                <div class="control-group">
                                    <input type="tel" value="{{$company_profile['company_arr']->phone}}" placeholder="Phone*" name="phone" required class="input-block-level">
                                </div>
                                <div class="control-group">
                                    <input type="text" value="{{$company_profile['company_arr']->facebook_url}}" name="facebook_url" placeholder="Facebook URL or www.facebook.com/example *" required class="input-block-level">
                                </div>
                                <div class="control-group">
                                    <select name="location" id="" class="input-block-level">
                                        <option value="Yangon" @if($company_profile['company_arr']->location=="Yangon") selected @endif>Yangon</option>
                                        <option value="Mandalay" @if($company_profile['company_arr']->location=="Mandalay") selected @endif>Mandalay</option>
                                        <option value="Other" @if($company_profile['company_arr']->location=="Other") selected @endif>Other</option>
                                    </select>
                                </div>
                                <div class="control-group">
                                    <textarea name="address" id="" cols="30" rows="5" class="input-block-level" placeholder="Address">{{$company_profile['company_arr']->address}}</textarea>
                                </div>
                                <div class="control-group">
                                    <br>
                                    <label for="">Google Map Latiute/Longitube</label>
                                    <input type="text" value="{{$company_profile['company_arr']->google_map_lat}}" name="google_map_lat" placeholder="Lat" class="input-block-level" required>
                                    <input type="text" value="{{$company_profile['company_arr']->google_map_lon}}" name="google_map_lon" placeholder="Long" class="input-block-level" required>
                                </div>
                                <div class="control-group">
                                    <textarea name="description" id="" cols="30" rows="5" class="input-block-level" placeholder="Description">{{$company_profile['company_arr']->description}}</textarea>
                                </div>
                                <div class="control-group">
                                    <textarea name="vision_and_mission" id="" cols="30" rows="5" class="input-block-level" placeholder="Vision and Mission">{{$company_profile['company_arr']->vision_and_mission}}</textarea>
                                </div>
                                <div class="control-group">
                                    <textarea name="what_we_do" id="" cols="30" rows="5" class="input-block-level" placeholder="What We Do">{{$company_profile['company_arr']->what_we_do}}</textarea>
                                </div>
                                <div class="control-group">
                                    <textarea name="why_join_us" id="" cols="30" rows="5" class="input-block-level" placeholder="Why Join Us">{{$company_profile['company_arr']->why_join_us}} </textarea>
                                </div>
                                <div class="control-group">
                                    <input type="submit" value="Save" class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                        <div class="span4">
                            <form action="">
                                <br><br>
                                <h5>
                                    Header
                                </h5>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>

                                <hr>
                                <h5>
                                    Header
                                </h5>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>

                                <hr>
                                <h5>
                                    Header
                                </h5>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>
                                <div class="control-group">
                                    <input type="checkbox" id="hello_1"> <span class="help-inline"> Hello World</span>
                                </div>

                                <br>
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End-Chart-box-->
        <hr/>

    </div>

<!--end-main-container-part-->
@endsection