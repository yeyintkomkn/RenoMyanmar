@extends('layouts.company_admin.company_admin_design')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css">--}}
    <style>
        .main_br_input input{
            margin-top: 35px;
        }

    </style>
@endsection
@section('nav_bar_text')
    Company Profile
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            @if(Session::has('success_msg'))
                <div class="row">
                    <div class="col-md-12">
                        <p style="color:#9B34B2">{{ session('success_msg') }}</p>
                    </div>

                </div>
            @endif
            <div class="row">
                <div class="col-md-8 offset-md-2 main_br_input">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">Complete your profile</p>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/company/company_profile')}}" enctype="multipart/form-data" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="photo"><img src="{{$company_profile->photo_url}}" id="image" style="width:150px;height: 150px"></label>
                                            <input type="file" class="form-control" id="photo" name="logo" onchange="displaySelectedPhoto('photo','image')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">CompanyName</label>
                                            <input type="text" class="form-control" name="company_name" required value="{{$company_profile->company_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Location</label>
                                            <select class="form-control" name="location">
                                                <option value="Yangon" @if($company_profile->location=="Yangon") selected @endif>Yangon</option>
                                                <option value="Mandalay"  @if($company_profile->location=="Mandalay") selected @endif>Mandalay</option>
                                                <option value="Other"  @if($company_profile->location=="Other") selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{$company_profile->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone</label>
                                            <input type="tel" class="form-control" name="phone" value="{{$company_profile->phone}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Adress</label>
                                            <input type="text" class="form-control" name="address" value="{{$company_profile->address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Facebook</label>
                                            <input type="text" class="form-control" name="facebook_url" value="{{$company_profile->facebook_url}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Website</label>
                                            <input type="text" class="form-control" name="website_url" value="{{$company_profile->website_url}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Vision And Mission</label>
                                            <textarea class="form-control" rows="5" name="vision_and_mission">{{$company_profile->vision_and_mission}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">What We Do</label>
                                            <textarea class="form-control" rows="5" name="what_we_do">{{$company_profile->what_we_do}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Why Join Us</label>
                                            <textarea class="form-control" rows="5" name="why_join_us">{{$company_profile->why_join_us}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

