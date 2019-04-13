@extends('layouts.company_admin.company_admin_design')


@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        img.card-img-top{
            border: 2px dotted #ccc;
            box-shadow: 0px 0px 1px #000;
        }
        img.light_box_img{
            margin-left:30%!important;
            margin-right: 30%!important;
        }
        .up_load_photo{
            margin-left:31%;
        }
        .model-footer-1 {
            border: transparent;
        }
    </style>
@endsection

@section('nav_bar_text')
    Photo
@endsection


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
               @for($i=0;$i<8;$i++)
               <div class="col-md-3">
                   @if(isset($company_project[$i]))
                   <div class="card">
                       <img style="height: 180px" class="card-img-top" src="{{asset('/upload/company_project/'.$company_project[$i]->photo)}}" alt="Card image cap">
                       <div class="card-body">
                           <p class="card-text text-center">{{$company_project[$i]->project_title}}</p>
                       </div>
                       <div class="card-footer">
                           <button type="button" class="btn btn-primary btn-block" onclick="show_edit_model({{$company_project[$i]->id}})">
                               Edit
                           </button>
                       </div>
                   </div>
                   @endif
                   @if(!isset($company_project[$i]))
                    <div class="card">
                       <img style="height: 180px" class="card-img-top" src="{{asset('/upload/company_project/no_images.jpg')}}" alt="Card image cap">
                       <div class="card-body">
                          <p class="card-text text-center">No Title</p>
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
                <form method="post" action="{{url('/company/company_insert_or_edit_project')}}" enctype="multipart/form-data" class="">
                    {{csrf_field()}}
                    <input type="hidden" name="type" id="type">
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="modal-body">
                       <img id="image" style="height: 180px;width:200px;" class="card-img-top light_box_img" src="{{asset('/upload/company_project/no_images.jpg')}}" alt="Card image cap">
                       <div class="card-body">
                          <label for="upload_photo" class="btn btn-success up_load_photo"><i class="fa fa-photo"></i> &nbsp;Upload photo</label>
                          <input class="form-control upload_photo" type="file" accept="image/*" name="photo" placeholder="Text Here..." id="upload_photo" onchange="displaySelectedPhoto('upload_photo','image')" style="visibility: hidden">
                          <input class="form-control" type="text" id="title" name="title" placeholder="Text Here..." required>
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
                }
                else{
                    $.ajax({
                        type: 'post',
                        url: '../company/photo_detail/'+id,
                        // data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
                            var data=JSON.parse(data_return);
                            console.log(data);
                            $('#type').val('update');
                            $('#title').val(data.project_title);
                            $('#project_id').val(data.id);
                            document.getElementById('image').src=data.photo_url;

//                            $('#model_blog_title').html(data.title);
//                            $('#model_blog_description').html(data.description);
//                            document.getElementById('model_blog_img').src=data.photo_url;
                            $('#model_box').modal('show');
//                            load_data();
                        },
                    });
                }

            }
        });
    </script>
    @endsection