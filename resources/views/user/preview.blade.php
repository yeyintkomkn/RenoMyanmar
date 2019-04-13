
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')


@section('css')
    <meta name="csrf-token" content="{{csrf_token()}}"/>

@endsection
@section('content')
    <img src="{{asset('images/frontend_images/page_banner.jpg')}}" alt="" class="img-responsive">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4">--}}
                            {{--<img src="{{asset('images/frontend_images/gh.png')}}" alt="" class="img-responsive" style="border: 1px dotted #777;">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{$data['username']}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$data['email']}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$data['phone']}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$data['address']}}</td>
                            </tr>
                            <tr>
                                <th>Budget</th>
                                <td>
                                   {{$data['budget_range']}}
                                </td>
                            </tr>
                            <tr>
                                <th>Service Type</th>
                                <td>
                                    @foreach($main_categories as $category)
                                        @foreach($data['service_type'] as $aa)
                                            @if($category->id==$aa)
                                                {{$category->category_name}},
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Project Type</th>
                                <td>
                                    @foreach($keywords as $keyword)
                                        @foreach($data['project_type'] as $aa)
                                            @if($keyword->id==$aa)
                                                {{$keyword->name}},
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Expected Project Start Date</th>
                                <td>{{$data['start_date']}}</td>
                            </tr>
                            <tr>
                                <th>Current Situation</th>
                                <th>{{$data['current_situation']}}</th>
                            </tr>
                            <tr>
                                <th>Brief Description</th>
                                <th>{{$data['description']}}</th>
                            </tr>
                        </table>
                    </div>


                    <a href="{{url('edit_request_quote')}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
                </div>


                <div class="col-md-4">
                    <h3>
                        Select Company
                    </h3>
                    <form id="employee_insert">
                        {{csrf_field()}}
                        <div style="display: none;">
                            <input type="hidden" name="file_name" value="{{$data['file_name']}}">
                            <input type="hidden" name="username" value="{{$data['username']}}">
                            <input type="hidden" name="email" value="{{$data['email']}}">
                            <input type="hidden" name="phone" value="{{$data['phone']}}">
                            <input type="hidden" name="address" value="{{$data['address']}}">
                            <input type="hidden" name="budget_range" value="{{$data['budget_range']}}">
                            @foreach($data['service_type'] as $aa)
                                <input type="checkbox" name="service_type[]" value="{{$aa}}" checked>
                            @endforeach

                            @foreach($data['project_type'] as $pp)
                                <input type="checkbox" name="project_type[]" value="{{$pp}}" checked>
                            @endforeach
                            <input type="hidden" name="start_date" value="{{$data['start_date']}}">
                            <input type="hidden" name="current_situation" value="{{$data['current_situation']}}">
                            <input type="hidden" name="description" value="{{$data['description']}}">
                            {{--<input type="hidden" name="file" value="{{$data['file']}}">--}}
                        </div>
                        <div class="table-name well">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-check"></i></th>

                                    <th>Company Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($company_list as $data)
                                <tr>
                                    <td><input type="checkbox" name="selected_companies[]" value="{{$data->id}}"></td>
                                    <td><a href="{{url('company_profile/'.$data->id)}}" target="_blank">{{$data->company_name}}</a> </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

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
                        <input type="submit" class="btn btn-success btn-block"></a>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

//            var t=$("#employee_insert").DataTable({
//                "ordering": false,
//                // "paging": false,
//                "bInfo" : false,
//                // "bPaginate": false,
//                "bLengthChange": false,
//                // "bFilter": true,
//                // "bAutoWidth": false
//            });




            $('#employee_insert').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'post',
                    url: '{{"request_quote"}}',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(dara) {
//                        var data_return=JSON.parse(dara);
//                       console.log(data_return);
                        alert(dara);
//                        console.log(dara);
                    }
                });
            });


        });


    </script>

@endsection