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
    Manage Blog
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: -20px;">
                <div class="scroll_well" style="position: fixed;max-width: 25%;z-index: 100;">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Create Blog Post</h4>
                            {{--<p class="card-category">Complete your profile</p>--}}
                        </div>
                        <div class="card-body">
                            <form id="insert_form" method="post" enctype="multipart/form-data" class="md-form">
                                {{csrf_field()}}
                                <input type="hidden" id="blog_id" value="0" name="blog_id">
                                <div class="row">
                                    <div class="col-sm-12 imgUp">
                                        <img id="image" class="imagePreview">
                                        <label class="btn btn-primary">
                                            Upload<input type="file" onchange="displaySelectedPhoto('upload_photo','image')" id="upload_photo" name="photo" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                        </label>
                                    </div><!-- col-2 -->
                                    {{--<i class="fa fa-plus imgAdd"></i>--}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Title</label>
                                            <input type="text" name="title" id="title" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Write Here...</label>
                                                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-right" id="btn_submit">Create</button>
                                <div class="clearfix"></div>
                            </form>


                        </div>




                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-8">
                   <div class="card">
                       <div class="card-body">
                           <table id="datatable">
                               <thead>
                               <tr>
                                   <th>No</th>
                                   <th>Photo</th>
                                   <th width="500px">Title</th>
                                   <th width="100px">Action</th>
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


     {{--Blog detail Model--}}
    <div class="modal fade" id="detail_blog" role="dialog">
        <div class="modal-dialog" style="max-width:800px!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Blog Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 id="model_blog_title">
                                Blog Title
                            </h3>
                        </div>
                        <div class="col-md-12">
                            <img id="model_blog_img" src="" alt="" class="img-responsive" width="100%">
                        </div>
                        <div class="col-md-12">
                            <br>
                            <p id="model_blog_description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet at beatae consequuntur cumque cupiditate earum illum iste iure laudantium magnam magni minus nesciunt odit, praesentium quaerat quasi tempore unde, voluptas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    url: '{{url("create_or_edit_admin_blog")}}',
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
                    url: "{{url('api/all_blog')}}",
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        data_list=JSON.parse(data_return);
                        console.log(data_list);
                        set_data(data_list);

                    }
                });
            }

            set_data=function (data_list) {
                t.clear();
                var no=1;
                for (var i=data_list.length-1;i>=0;i--){
                    t.row.add( [
                        (no++),
                        '<img src="'+data_list[i].photo_url+'" style="width: 100px;height: 100px;"></img>',
                        data_list[i].title,
//                        '<button type="button" rel="tooltip" title="ViewDetail" class="btn btn-primary btn-link btn-sm"><i class="material-icons" onclick="detail_list('+i+')">info</i></button>'+
//                        '<button type="button" rel="tooltip" title="Edit" class="btn btn-success btn-link btn-sm"><i class="material-icons" onclick="edit_list('+i+')">edit</i></button>'+
//                        '<button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm"><i class="material-icons" onclick="delete_list('+i+')">delete</i></button>'

                        '<button class="btn btn-sm btn-default" onclick="detail_list('+data_list[i].id+')">Detail</button>'+
                        '<button class="btn btn-sm btn-primary" onclick="edit_list('+i+')">Edit</button>'+
                        '<button class="btn btn-sm btn-danger" onclick="delete_list('+data_list[i].id+')">Delete</button>'

                    ] ).draw( false );
                }
                $('#blog_id').val(0);
                $('#btn_submit').html('Create');
                $('#insert_form')[0].reset();
                $('#image').attr('src','http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg');
            },

                edit_list=function(index) {
                    console.log(data_list[index]);
                    var data=data_list[index];
                    document.getElementById("image").src=data.photo_url;
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    $('#blog_id').val(data.id);
                    $('#btn_submit').html('Edit');
                },

            delete_list=function(id) {
                var result=window.confirm("Are You Sure To Delete!");
                if(result){
                    $.ajax({
                        type: 'post',
                        url:'../delete_admin_blog/'+id,
//                         data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
                            load_data();
                        },
                    });
                }
            },

            detail_list=function(id) {
                $.ajax({
                    type: 'post',
                    url: '../api/blog_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data=JSON.parse(data_return);
                        console.log(data);
                        $('#model_blog_title').html(data.title);
                        $('#model_blog_description').html(data.description);
                        document.getElementById('model_blog_img').src=data.photo_url;
                        $('#detail_blog').modal('show');
//                            load_data();
                    },
                });
            }


        });


    </script>
@endsection