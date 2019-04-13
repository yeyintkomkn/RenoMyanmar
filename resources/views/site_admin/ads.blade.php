@extends('layouts.site_admin.site_admin_design')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        .imagePreview {
            width: 100%;
            height: 150px;
            background-position: center center;
            background:url('http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg');
            background-color:#fff;
            background-size: cover;
            background-repeat:no-repeat;
            display: inline-block;
            box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
        }
        .btn-primary
        {
            display:block;
            border-radius:0px;
            box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
            margin-top:-5px;
        }
        .imgUp
        {
            margin-bottom:15px;
        }
    </style>
@endsection
@section('nav_bar_text')
    Manage Ads
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: -20px;">

                <div class="col-md-4">
                    <div class="scroll_well" style="position: absolute;max-width: 90%;z-index: 100;">
                        {{--<div class="scroll_well">--}}
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Create Ads</h4>
                                {{--<p class="card-category">Complete your profile</p>--}}
                            </div>
                            <div class="card-body">
                                <form id="insert_form" method="post" enctype="multipart/form-data" class="md-form">
                                    {{csrf_field()}}
                                    <input type="hidden" id="ads_id" value="0" name="ads_id">
                                    <div class="row">
                                        <div class="col-sm-12 imgUp">
                                            <img id="image" class="imagePreview" >
                                            <label class="btn btn-primary">
                                                Upload<input type="file" onchange="displaySelectedPhoto('upload_photo','image')" id="upload_photo" name="photo" class="uploadFile img" value="Upload Photo" required style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div><!-- col-2 -->
                                        {{--<i class="fa fa-plus imgAdd"></i>--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link</label>
                                                <input type="text" required class="form-control" name="link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Start Date</label>
                                                <input type="date" required class="form-control" name="start_date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">End Date</label>
                                                <input type="date" required class="form-control" name="end_date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Select Webpage</label>
                                                <ul style="list-style-type: none">

                                                    @foreach($webpages as $data)
                                                        <li>
                                                            <input type="checkbox" name="webpage[]" id="{{$data->id}}" value="{{$data->id}}">
                                                            <label for="{{$data->id}}" >{{$data->name}}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary pull-right" id="btn_submit">Create</button>
                                    <div class="clearfix"></div>
                                </form>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>WebPages</th>
                                    <th>StartDate</th>
                                    <th>Status</th>
                                    <th>EndDate</th>

                                    <th>Action</th>
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



@endsection

@section('js')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.16/js/mdb.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //        function ajax_set_admin_data()

        $(document).ready(function() {

            load_data();


            $('#insert_form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'post',
                    url: '{{url("create_or_edit_ads")}}',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        alert("Success");
                        load_data();

                    },
                });
            });

            var t=$("#datatable").DataTable({
                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false,
                // "bFilter": true,
                // "bAutoWidth": false
            });
            var data_list;
            function load_data() {
                $.ajax({
                    type: 'post',
                    url: "{{url('api/all_ads')}}",
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        data_list=JSON.parse(data_return);
                        console.log(data_list[0].webpage_name);
                        set_data(data_list);

                    }
                });
            }

            set_data=function (data_list) {
                t.clear();
                var no=1;
                for (var i=data_list.length-1;i>=0;i--){
                    var status_class="success";
                    var today = new Date();

                    t.row.add( [
                        (no++),
                        '<img src="'+data_list[i].photo_url+'" style="width: 100px;height: 100px;"></img>',
                        data_list[i].webpage_name,
                        data_list[i].start_date,
                        '<button class="btn btn-sm btn-'+data_list[i].status+'">Status</button>',
                        data_list[i].end_date,

                        '<button class="btn btn-sm btn-danger" onclick="delete_list('+data_list[i].id+')">Delete</button>'

                    ] ).draw( false );
                }
                $('#ads_id').val(0);
                $('#btn_submit').html('Create');
                $('#insert_form')[0].reset();
                $('#image').attr('src','http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg');
            },


                delete_list=function(id) {
                    var result=window.confirm("Are You Sure To Delete!");
                    if(result){
                        $.ajax({
                            type: 'post',
                            url:'../delete_ads/'+id,
//                         data:"id="+id,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(data_return) {
                                load_data();
                            },
                        });
                    }
                }
        });


    </script>
@endsection