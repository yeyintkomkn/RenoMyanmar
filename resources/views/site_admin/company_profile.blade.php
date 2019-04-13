@extends('layouts.site_admin.site_admin_design')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/css/mdb.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css">--}}
    <style>
        .main_br_input input{
            margin-top: 35px;
        }
        .under_next:hover{
            color: #fff;
            opacity: 0.8;
        }
        .under_next{
            position: fixed;
            z-index: 99999;
            bottom: 10px;
            right: 30px;
            width: 50px;
            padding: 11px;
            height: 50px;
            line-height: 10px;
            background-color: #800080;
            border: 5px solid #ccc;
            border-radius: 100%;
            color: #fff;
            font-size:20px;
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
                        <div class="col-md-12">
                            <a href="#next_under" class="under_next" data-toggle="tooltip" title="Go to under"><i class="fa fa-arrow-down"></i></a>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2 main_br_input">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Edit Profile</h4>
                                <p class="card-category">Complete your profile</p>
                            </div>
                            <div class="card-body">
                                <form action="{{url('admin/company_profile/update_company_profile')}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{$company_profile->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Phone</label>
                                                <input type="tel" class="form-control" name="phone" value="{{$company_profile->phone}}">
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Video</label>
                                                <input type="text" class="form-control" name="video" value="{{$company_profile->video}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Android App Download Link</label>
                                                <input type="text" class="form-control" name="android" value="{{$company_profile->android}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">IOS App Download Link</label>
                                                <input type="text" class="form-control" name="ios" value="{{$company_profile->ios}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Facebook</label>
                                                <input type="text" class="form-control" name="facebook" value="{{$company_profile->facebook}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Google+</label>
                                                <input type="text" class="form-control" name="google" value="{{$company_profile->google}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Twitter</label>
                                                <input type="text" class="form-control" name="twitter" value="{{$company_profile->twitter}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Instragram</label>
                                                <input type="text" class="form-control" name="instragram" value="{{$company_profile->instragram}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">About Us</label>
                                                <textarea class="form-control" rows="4" name="about_us">{{$company_profile->about_us}}</textarea>
                                                {{--<input type="text" class="form-control" name="about_us" value="{{$company_profile->about_us}}">--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">What We Do</label>
                                                <textarea class="form-control" rows="4" name="what_we_do">{{$company_profile->what_we_do}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Our Vision and Mission</label>
                                                <textarea class="form-control" rows="4" name="vision_and_mission">{{$company_profile->vision_and_mission}}</textarea>
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



                <div class="row">
                        <div class="col-md-4">
                            <div class="card" id="next_under">
                                <div class="card-header">
                                    Add New Category
                                </div>
                                <form id="insert_form" class="card-body" action="" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" id="form_type" value="main">
                                    <div class="form-group">
                                        <label for="categroy_name" class="bmd-label-floating">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="categroy_name">
                                    </div>
                                    <div class="form-group row">
                                        <div class="radio col-md-6">
                                            <label>
                                                <input type="radio" onclick="hide_main_category()" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                Main Category
                                            </label>
                                        </div>
                                        <div class="radio col-md-6">
                                            <label>
                                                <input type="radio" onclick="show_main_category()" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Sub Category
                                            </label>
                                        </div>
                                    </div>
                                    <div id="main_option" style="display: none" class="form-group">
                                        <label for="main_category_id" class="bmd-label-floating">Select Main Category</label>
                                        <select class="form-control" id="main_category_id" name="main_category_id">
                                           {{--@foreach($main_categories as $data)--}}
                                            {{--<option value="{{$data->id}}">{{$data->category_name}}</option>--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>
                                    <div id="subcategory_logo" style="display: none" class="form-group">
                                        <label for="logo" class="bmd-label-floating">Logo(fontawesome class)</label>
                                        <input type="text" class="form-control" id="logo" name="logo">
                                    </div>
                                    {{--<button class="btn btn-default">Cancel</button>--}}
                                    <button type="submit" class="btn btn-primary btn-raised">Add</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-5 card">
                                    <div class="">
                                        <div>
                                            <h3>
                                                &nbsp;Main Category
                                            </h3>
                                            <table id="maindatatable" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Category</th>
                                                    <th>Control</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>



                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 card ml-2">
                                    <div class="">
                                        <div>
                                            <h3 id="title">
                                                &nbsp;Sub Category
                                            </h3>
                                            <table id="subdatatable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category</th>
                                                        <th>Logo</th>
                                                        <th>Control</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>



                                            </table>
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
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>--}}

    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/js/mdb.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>--}}

    <script>
        function show_main_category() {
            var main=document.getElementById('main_option');
            var subcategory_logo=document.getElementById('subcategory_logo');
            var form_type=document.getElementById('form_type');
            main.style.display="block";
            subcategory_logo.style.display="block";
            form_type.value="sub";
            $.ajax({
                type: 'post',
                url: '{{url("api/get_main_category")}}',
                cache:false,
                contentType: false,
                processData: false,
                success: function(result) {
                    var data=JSON.parse(result);
//                    console.log(data);
                    var main_category=document.getElementById("main_category_id");
                    main_category.innerHTML="";
                    for(var i=0;i<data.length;i++){
                        var option=document.createElement("option");
                        option.value=data[i].id;
                        option.innerHTML=data[i].category_name;
                        main_category.appendChild(option);
                    }

                },
            });
        }

        function hide_main_category() {
            var main=document.getElementById('main_option');
            var subcategory_logo=document.getElementById('subcategory_logo');
            var form_type=document.getElementById('form_type');
            main.style.display="none";
            subcategory_logo.style.display="none";
            form_type.value="main";
        }

        $("[data-tooltip='tooltip']").tooltip();
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //        function ajax_set_admin_data()

        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();

            var temp_main_id;
            load_data();

            $('#insert_form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                var form_type=document.getElementById("form_type");
                var request_link;
                if(form_type.value==="main"){
                    request_link='{{url("add_main_category")}}';
                }
                else{
                    request_link='{{url("add_sub_category")}}';
                }
                $.ajax({
                    type: 'post',
                    url: request_link,
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        alert("Success");
                        load_data();
                        $('#insert_form')[0].reset();
                    },
                });
            });

            var main_category_t=$("#maindatatable").DataTable({
                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false,
                // "bFilter": true,
                // "bAutoWidth": false
            });

            var sub_category_t=$("#subdatatable").DataTable({
                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false,
                // "bFilter": true,
                // "bAutoWidth": false
            });

            $('#maindatatable tbody').on('click', 'tr', function () {
                var data = main_category_t.row( this ).data();
                var main_category_id=data[0];
                temp_main_id=main_category_id;
                load_sub_category(main_category_id);
            } );

            function load_data() {
              load_main_category();
              load_sub_category(1);
            }

            function load_main_category() {
                $.ajax({
                    type: 'post',
                    url: "{{url('api/get_main_category')}}",
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var aaa="aaa";
                        var data_list=JSON.parse(data_return);
                        main_category_t.clear().draw();
                        var no=1;
                        for (var i=0;i<data_list.length;i++){
                            main_category_t.row.add( [
                                (no++),
                                data_list[i].category_name,
                                '<button class="btn btn-sm btn-danger" onclick="delete_main_list('+data_list[i].id+')">Delete</button>'

                            ] ).draw( false );
                        }
                    }
                });
            }
            function load_sub_category(main_category_id) {
                $.ajax({
                    type: 'post',
                    url: "../api/get_sub_category/"+main_category_id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data_list=JSON.parse(data_return);
                        var main_category=data_list[0]['main_category_data'];
                        $('#title').html(main_category.category_name);
                        sub_category_t.clear().draw();
                        var no=1;
                        for (var i=0;i<data_list.length;i++){
                            sub_category_t.row.add( [
                                (no++),
                                data_list[i].category_name,
                                data_list[i].logo,
                                '<button class="btn btn-sm btn-danger" onclick="delete_sub_list('+data_list[i].id+')">Delete</button>'

                            ] ).draw( false );
                        }
                    }
                });
            }

            delete_main_list=function (id) {
                delete_list(id,"main");
            };
            delete_sub_list=function (id) {
                delete_list(id,"sub");
            };
            delete_list=function(id,category_type) {
                var result=window.confirm("Are You Sure To Delete!");
                var request_link;
                if(result){
                    if(category_type==="main"){
                        request_link='../delete_main_category/'+id;
                    }
                    else{
                        request_link='../delete_sub_category/'+id;
                    }
                    $.ajax({
                        type: 'post',
                        url:request_link,
//                         data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
                            if(category_type==="main"){
                                load_data();
                            }
                            else{
                                load_sub_category(temp_main_id);
                            }

                        },
                    });
                }
            }


        });


    </script>
@endsection