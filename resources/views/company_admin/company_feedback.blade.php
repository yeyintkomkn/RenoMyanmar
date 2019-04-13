@extends('layouts.company_admin.company_admin_design')


@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card-img-top{
            border: 2px dotted #ccc;
            box-shadow: 0px 0px 2px #000;
        }
        .model-footer-1 {
            border: transparent;
        }
        img.light_box_img{
            margin-left:30%!important;
            margin-right: 30%!important;
        }
        .up_load_photo{
            margin-left:31%;
        }
    </style>
@endsection

@section('nav_bar_text')
    Company Feedback
@endsection


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @for($i=0;$i<9;$i++)
                    <div class="col-md-4">
                        @if(isset($company_feedback[$i]))
                            <div class="card">
                                <img style="height: 200px" class="card-img-top" src="{{$company_feedback[$i]['photo_url']}}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-header text-center">{{$company_feedback[$i]['name']}}</h3>
                                    <p class="card-text text-center">{{substr($company_feedback[$i]['description'],0,150)}}</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary btn-block" onclick="show_edit_model({{$company_feedback[$i]['id']}})">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if(!isset($company_feedback[$i]))
                            <div class="card">
                                <img style="height: 200px" class="card-img-top" src="{{asset('/upload/company_project/no_images.jpg')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-header">No Data</h3>
                                    <p class="card-text" style="height: 95px">No Data</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary btn-block" onclick="show_edit_model(0)">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="model_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{url('company/company_insert_or_edit_feedback')}}" enctype="multipart/form-data" class="">
                    {{csrf_field()}}
                    <input type="hidden" name="type" id="type">
                    <input type="hidden" name="feedback_id" id="feedback_id">
                    <div class="modal-body">
                        <img id="image" style="height: 180px;width:200px;" class="card-img-top light_box_img" src="{{asset('/upload/company_project/no_images.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <label for="feed_back_up" class="btn btn-success up_load_photo"><i class="fa fa-photo"></i> &nbsp;Upload photo</label>
                            <input class="form-control" type="file" accept="image/*" name="photo" placeholder="Text Here..." style="visibility: hidden;" id="feed_back_up" onchange="displaySelectedPhoto('feed_back_up','image')">
                            <input class="form-control" type="text" id="title" name="name" placeholder="Text Here..." required>
                            <br>
                            {{--<input class="form-control" type="text" id="description" name="description" placeholder="Text Here...">--}}
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Write here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer model-footer-1">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //        function ajax_set_admin_data()

        $(document).ready(function() {
            show_edit_model=function(id){
                //if insert
                if(id===0){
                    $('#type').val('insert');
                    $('#model_box').modal('show');
                    document.getElementById('image').src="{{asset('/upload/company_project/no_images.jpg')}}";
                }
                else{
                    $.ajax({
                        type: 'post',
                        url: '../company/company_feedback_detail/'+id,
                        // data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
                            var data=JSON.parse(data_return);
                            console.log(data);
                            $('#type').val('update');
                            $('#title').val(data.name);
                            $('#description').val(data.description);
                            $('#feedback_id').val(data.id);
                            document.getElementById('image').src=data.photo_url;
                            $('#model_box').modal('show');
//                            load_data();
                        },
                    });
                }

            }
        });
    </script>
@endsection