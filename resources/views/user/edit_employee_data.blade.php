
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')

@section('content')
    <img src="{{asset('images/frontend_images/page_banner.jpg')}}" alt="" class="img-responsive">
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <h4>
                        <i class="fa fa-edit"></i> Edit
                    </h4>
                    <div class="well">
                        <form action="{{url('preview')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="username" value="{{$data['username']}}" class="form-control" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" value="{{$data['email']}}" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <input type="tel" name="phone" value="{{$data['phone']}}" class="form-control" placeholder="Phone">
                            </div>

                            <div class="form-group">
                                <textarea name="address" id="" cols="30" rows="3" class="form-control" placeholder="Address">{{$data['address']}}</textarea>
                            </div>

                            <div class="form-group">
                                <select name="budget_range" id="" class="form-control">
                                    <option value="--no-select--">--Budget Range--</option>
                                    <option value="50laks" @if($data['budget_range']=="50laks") selected @endif> 50 Lakhs </option>
                                    <option value="100laks" @if($data['budget_range']=="100laks") selected @endif>100 Lakhs </option>
                                    <option value="200laks" @if($data['budget_range']=="200laks") selected @endif>200 Lakhs </option>
                                    <option value="300laks" @if($data['budget_range']=="300laks") selected @endif>300 Lakhs </option>
                                    <option value="more300laks" @if($data['budget_range']=="more300laks") selected @endif>More than 300 Lakhs </option>
                                </select>
                            </div>


                            <h5>
                                Service Type
                            </h5>

                            @foreach($main_categories as $category)

                                <input type="checkbox" name="service_type[]" id="construction" value="{{$category->id}}"
                                @foreach($data['service_type'] as $category_id)
                                        @if($category_id==$category->id)
                                            checked
                                            @endif
                                        @endforeach
                                > <label for="construction"> {{$category->category_name}}</label> &nbsp;

                            @endforeach
                            <hr>

                            <!-- ===================== -->
                            <h5>
                                Project Type
                            </h5>

                            @foreach($keywords as $keyword)

                                <input type="checkbox" name="project_type[]" value="{{$keyword->id}}" id="residential"
                                @foreach($data['project_type'] as $keyword_id)
                                    @if($keyword_id==$keyword->id)
                                       checked
                                    @endif
                                @endforeach
                                > <label for="residential"> {{$keyword->name}}</label> &nbsp;&nbsp;

                            @endforeach
                            <hr>
                            <h5>
                                Expected Project Start Date*
                            </h5>

                            <input type="date" value="{{$data['start_date']}}" name="start_date" class="form-control" required>
                            <hr>

                            <input type="text" value="{{$data['current_situation']}}" name="current_situation" placeholder="Current Situation*" class="form-control" required>

                            <input type="text" value="{{$data['description']}}" name="description" placeholder="Brief Description*" class="form-control" required>

                            <input type="submit" class="btn btn-success btn-block" value="UPDATE">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection