@extends('layouts.site_admin.site_admin_design')
@section('css')
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <style>
        table{
            position: relative;
            z-index: 1;
        }
        .po_sition{
            position: absolute;
            margin-top:-30px;
            margin-left:-200px;
            z-index: 99999;
        }
        .hidden{

            visibility: hidden;
        }
    </style>
    <style>
        #radioBtn .notActive{
            color: #3276b1;
            background-color: #fff;
        }
    </style>




    <style>
        #myModal_view .modal-dialog,
        #myModal_edit .modal-dialog,
        #myModal_employee .modal-dialog,
        #myModal_employee_2 .modal-dialog{
            max-width: 800px;
        }
        #myModal_view .modal-body img,
        #myModal_employee .modal-body img,
        #myModal_employee_2 .modal-body img{
            border: 2px dotted #ccc;
            border-radius: 3px;
        }
        #myModal_view a,
        #myModal_employee a,
        #myModal_employee_2 a{
            color: #000;
        }
        #myModal_view h3,
        #myModal_employee h3,
        #myModal_employee_2 h3{
            color: #800080;
            font-family: times;
        }
        #myModal_view .file_email,
        #myModal_employee .file_email,
        #myModal_employee_2 .file_email{
            padding: 5px;
            margin-top: 30px;
            text-align: center;
            height: 150px;
            border: 2px dashed #800080;
            margin-bottom: 30px;
            border-radius: 0px 30px 0px 0px;
        }
        #myModal_view .fas,
        #myModal_view .fab,
        #myModal_employee .fas,
        #myModal_employee .fab,
        #myModal_employee_2 .fas,
        #myModal_employee_2 .fab{
            color: #800080;
        }

        /*=================================*/
        /*Edit*/
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }
        .files input:focus{ outline: 2px dashed #92b0b3; outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
        }
        .files{ position:relative}
        .files:after { pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .color input{ background-color:#f1f1f1;}
        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0; pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " or drag it here. ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
        /*#myModal_edit input,*/
        /*#myModal_edit textarea{*/
            /*border: 1px solid #ccc!important;*/
        /*}*/
        #myModal_edit label{
            font-size: 20px;
            font-family: times;
            color: #800080;
        }

    </style>

@endsection
@section('nav_bar_text')
    Company List
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Pending Company</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="pending_company_datatable">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>FB</th>
                                        <th>WebSite</th>
                                        {{--<th>Address</th>--}}
                                        {{--<th>Location</th>--}}
                                        <th width="500px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class="card-title mt-0"> Company List</h4>
                                    <p class="card-category"> Here is a subtitle for this table</p>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div id="radioBtn" class="btn-group row">
                                            <a class="col-md-2 col-xs-6 col-sm-6 btn btn-primary active" data-toggle="fun" data-title="Y" onclick="change_company_data('all_company')">All Companies</a>
                                            <a class="col-md-2 col-xs-6 col-sm-6 btn btn-primary notActive" data-toggle="fun" data-title="X" onclick="change_company_data('top_company')">Top Companies</a>
                                            <a class="col-md-2 col-xs-6 col-sm-6 btn btn-primary notActive" data-toggle="fun" data-title="N" onclick="change_company_data('paid_company')">Paid Companies</a>
                                            <a class="col-md-2 col-xs-6 col-sm-6 btn btn-primary notActive" data-toggle="fun" data-title="A" onclick="change_company_data('free_company')">Free Companies</a>
                                            <a class="col-md-2 col-xs-6 col-sm-6 btn btn-primary notActive" data-toggle="fun" data-title="B" onclick="change_company_data('ban_company')">Ban Companies</a>
                                        </div>
                                        <input type="hidden" name="fun" id="fun">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="activated_company_datatable" class="table table-hover">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>FB</th>
                                        <th>Website</th>
                                        {{--<th>Address</th>--}}
                                        {{--<th>Location</th>--}}
                                        <th width="500px">Action</th>
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





    {{--company detail--}}
    <!-- The Modal -->
    <div class="modal" id="myModal_view">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span id="view_company_name"> </span>
                        <span class="badge badge-success" id="view_company_type"></span>    <!-- <span class="badge badge-pill badge-dark">Free ------ For Free ------</span> -->
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="" id="view_company_logo" alt="" class="img-fluid" style="width: 200px;height: 200px;">
                        </div>
                        <div class="col-md-4" id="company_link">
                            <a href="#" id="link_company_dashboard" target="_blank" class="btn btn-default btn-block btn-lg text-white rounded-0"><i class="fas fa-tachometer-alt text-white"></i> Dashboard</a>
                            <a href="#" id="link_company_profile" target="_blank" class="btn btn-default btn-block btn-lg text-white rounded-0"> Webpage <i class="fas fa-sign-out-alt text-white"></i></a>
                        </div>
                        <div class="col-md-12">


                        <!-- Hello I am Chit Min Thu
		        			Under line 'a' tag in "href='mailto:---@example.com'" is the Outlook App content link for redired mail!
		        			Redired it and target="_blank" is Bowser new tag or phone browser new tag -->

                            <!-- tel:098765433 is the redired call -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="file_email">
                                        <i class="fas fa-envelope fa-2x"></i>
                                        <h3>
                                            Email
                                        </h3>
                                        <a id="view_email" href="mailto:" target="_blank" data-toggle='tooltip' title="Click now!"></a>
                                        {{--<a href="mailto:chitminthu72745@gmail.com" target="_blank" data-toggle='tooltip' title="Click now!">chitminthu72745@gmail.com</a>--}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="file_email">
                                        <i class="fas fa-phone fa-2x"></i>
                                        <h3>
                                            Phone
                                        </h3>
                                        <a id="view_phone" href="tel:" data-toggle='tooltip' title="Click now!"></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="file_email">
                                        <i class="fas fa-home fa-2x"></i>
                                        <h3>
                                            Adderss
                                        </h3>
                                        <p id="view_address">

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <hr>

                            <div>
                                <h3>
                                    <i class="fas fa-paragraph"></i> Description
                                </h3>
                                <p id="view_description">

                                </p>
                            </div>
                            <hr>
                            <div>
                                <h3>
                                    <i class="fas fa-eye"></i> Vision and Mission
                                </h3>
                                <p id="view_vision_and_mission">

                                </p>
                            </div>
                            <hr>
                            <div>
                                <h3>
                                    <i class="fas fa-globe-asia"></i> What we do
                                </h3>
                                <p id="view_what_we_do">

                                </p>
                            </div>

                            <hr>
                            <div>
                                <h3>
                                    <i class="far fa-handshake"></i> Why join us
                                </h3>
                                <p id="view_why_join_us">

                                </p>
                            </div>

                            <hr>
                            <div>
                                <h3>
                                    <i class="fas fa-map-marker-alt"></i> Location
                                </h3>
                                <p id="view_location">
                                </p>
                            </div>

                            <hr>
                            <div>
                                <a id="view_facebook_url" href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Facebook" data-placement="bottom"><i class="fab fa-facebook fa-lg"></i></a>
                                <a id="view_website_url" href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Website" data-placement="bottom"><i class="fab fa-chrome fa-lg"></i></i></a>
                                {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Twitter" data-placement="bottom"><i class="fab fa-twitter fa-lg"></i></i></a>--}}
                                {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Google plus" data-placement="bottom"><i class="fab fa-google-plus fa-lg"></i></i></a>--}}
                            </div>


                        </div>
                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- edit Modal -->
    <div class="modal" id="myModal_edit">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span id="company_name_edit_box"></span>
                        <span class="badge badge-success" id="company_type_edit_box"></span>    <!-- <span class="badge badge-pill badge-dark">Free ------ For Free ------</span> --></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="update_form" action="{{url('edit_company_data')}}" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                    <!-- Modal body -->
                <div class="modal-body">
                        <input type="hidden" value="" id="company_id" name="id">
                        <div class="form-group color">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <img src="" alt="" id="image_edit_box" class="img-fluid">
                                    <label for="update_photo_new" class="btn btn-success btn-sm btn-block text-white"><i class="far fa-image"></i> Upload </label>
                                    <input type="file" name="photo" onchange="displaySelectedPhoto('update_photo_new','image_edit_box')" id="update_photo_new" class="form-control" style="visibility: hidden;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_company_name" data-toggle="tooltip" title="Change CompanyName">CompanyName</label><br>
                                    <input type="text" class="form-control" name="company_name" id="edit_company_name" placeholder="CompanyName" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_company_type" data-toggle="tooltip" title="Change CompanyName">CompayType</label><br>
                                    <input type="radio" class="edit_company_type" name="company_type" id="rdo_free" value="free"> <label for="rdo_free">Free</label><br>
                                    <input type="radio" class="edit_company_type" name="company_type" id="rdo_paid" value="paid">  <label for="rdo_paid">Paid</label><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="edit_company_email" name="email" type="text" class="form-control" placeholder="Email" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="edit_company_phone" name="phone" type="tel" class="form-control" placeholder="Phone" value="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="edit_company_address" name="address" type="text" class="form-control" placeholder="Address" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_company_description"  data-toggle="tooltip" title="Update click your description">Description</label>
                            <textarea name="description" id="edit_company_description" cols="20" rows="5" class="form-control">
			            	</textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_vision_and_mission" data-toggle="tooltip" title="Update click your Vision and Mission">Vision and Mission</label>
                            <textarea name="vision_and_mission" id="edit_vision_and_mission" cols="20" rows="5" class="form-control">
			            	</textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_what_we_do" data-toggle="tooltip" title="Update click your 'What we do'">What we do</label>
                            <textarea name="what_we_do" id="edit_what_we_do" cols="20" rows="5" class="form-control">
			            	</textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_why_join_us" data-toggle="tooltip" title="Update click your 'Why join us'">Why join us</label>
                            <textarea name="why_join_us" id="edit_why_join_us" cols="20" rows="5" class="form-control">
			            	</textarea>
                        </div>


                        <div class="form-group">
                            <label for="location" data-toggle="tooltip" title="Update click your 'Location'">Location</label>
                            <select name="location" id="location"  class="form-control">
                                <option value="--select location--">--select location--</option>
                                <option class="edit_location" value="Yangon">Yangon</option>
                                <option class="edit_location" value="Mandalay">Mandalay</option>
                                <option class="edit_location" value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_facebook_url">Facebook URL</label>
                            <input type="text" name="facebook_url" id="edit_facebook_url" class="form-control" value="https://www.facebook.com/allinoneNESW/">
                        </div>

                        <div class="form-group">
                            <label for="edit_website">Website URL</label>
                            <input type="text" id="edit_website" name="website_url" class="form-control" value="https://www.greenhackeronline.com/">
                        </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    {{--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
    <script src="{{url('js/admin_js/plugins/jquery.dataTables.min.js')}}"></script>

    <script>
        $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);

            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            load_pending_data();
            load_activated_data("all_company");


            show_btn=function(){
//                var btn=document.getElementsByClassName("hidden");
                console.log(this.innerHTML);
//                btn[0].style.visibility="visible";
//
            };

            $("[data-toggle='tooltip']").tooltip();

            var panding_table=$("#pending_company_datatable").DataTable({
                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });
            var activated_table=$("#activated_company_datatable").DataTable({
//                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });

            function load_pending_data() {
                $.ajax({
                    type: 'post',
                    url: "{{url('api/get_pending_company')}}",
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data_list=JSON.parse(data_return);
                        console.log(data_list[0]);
                        set_data(data_list,panding_table,'pending_company');
                    }
                });
            }

            function load_activated_data(data_type) {
                var link;
                var company_type='activated_company';
                if(data_type==="all_company"){
                    link="{{url('api/get_all_company')}}";
                }
                else if(data_type==="top_company"){
                    link="{{url('api/get_top_company')}}";
                    company_type="top_company";
                }
                else if(data_type==="free_company"){
                    link="{{url('api/get_free_company')}}";
                }
                else if(data_type==="paid_company"){
                    link="{{url('api/get_paid_company')}}";
                }
                else if(data_type==="ban_company"){
                    link="{{url('api/get_ban_company')}}";
                    company_type="ban_company";
                }

                $.ajax({
                    type: 'post',
                    url: link,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data_list=JSON.parse(data_return);
                        console.log(data_list[0]);
                        set_data(data_list,activated_table,company_type);
                    }
                });
            }


            set_data=function (data_list,data_table,company_type) {
//                console.log(data_list[1]);
                data_table.clear();
                var no=1;
                for (var i=data_list.length-1;i>=0;i--){
                    var action;
                    if(company_type==="pending_company"){
                        action='<button class="btn btn-sm btn-default" onclick="detail_list('+data_list[i].id+')">Detail</button>'+
                            '<button class="btn btn-sm btn-warning" onclick="edit_list('+data_list[i].id+')">Edit</button>'+
                            '<button class="btn btn-sm btn-success pl-3 pr-2" onclick="activate_company('+data_list[i].id+')">Activate</button>'+
                            '<button class="btn btn-sm btn-danger" onclick="delete_company('+data_list[i].id+')">Delete</button>'
                    }
                    else if(company_type==="activated_company" || company_type==="top_company" || company_type==="ban_company"){
                        if(company_type==="activated_company"){
                            action='<button class="btn btn-sm btn-default" onclick="detail_list('+data_list[i].id+')">Detail</button>'+
                                '<button class="btn btn-sm btn-warning" onclick="edit_list('+data_list[i].id+')">Edit</button>'+
                                '<button class="btn btn-sm btn-danger" onclick="delete_company('+data_list[i].id+')">Delete</button>';
                            if(data_list[i].status===0){
                                action+='<button class="btn btn-sm btn-outline-success" onclick="ban_company('+data_list[i].id+',1)">UnBan</button>';
//
                            }
                            else{
                                action+='<button class="btn btn-sm btn-success" onclick="ban_company('+data_list[i].id+',0)">Ban</button>';

                            }
                            if(data_list[i].is_top_company===false){
                                action+='<button class="btn btn-sm btn-primary" onclick="top_company('+data_list[i].id+',0)">AddToTop</button>';
                            }
                            else{
                                action+='<button class="btn btn-sm btn-outline-primary" onclick="top_company('+data_list[i].id+',1)">AddToTop</button>';
                            }
                        }
                        else if(company_type==="top_company"){
                            action='<button class="btn btn-sm btn-default" onclick="detail_list('+data_list[i].id+')">Detail</button>'+
                                '<button class="btn btn-sm btn-warning" onclick="edit_list('+data_list[i].id+')">Edit</button>'+
                                '<button class="btn btn-sm btn-danger" onclick="delete_company('+data_list[i].id+')">Delete</button>';
                            if(data_list[i].is_top_company===false){
                                action+='<button class="btn btn-sm btn-primary" onclick="top_company('+data_list[i].id+',0)">AddToTop</button>';
                            }
                            else{
                                action+='<button class="btn btn-sm btn-outline-primary" onclick="top_company('+data_list[i].id+',1)">AddToTop</button>';
                            }
                        }
                        else if(company_type==="ban_company"){
                            action='<button class="btn btn-sm btn-default" onclick="detail_list('+data_list[i].id+')">Detail</button>'+
                                '<button class="btn btn-sm btn-warning" onclick="edit_list('+data_list[i].id+')">Edit</button>'+
                                '<button class="btn btn-sm btn-danger" onclick="delete_company('+data_list[i].id+')">Delete</button>';
                            if(data_list[i].status===0){
                                action+='<button class="btn btn-sm btn-outline-success" onclick="ban_company('+data_list[i].id+',1)">UnBan</button>';
//
                            }
                            else{
                                action+='<button class="btn btn-sm btn-success" onclick="ban_company('+data_list[i].id+',0)">Ban</button>';

                            }
                        }

                    }

                    data_table.row.add( [
                        (no++),
                        "<img src='"+data_list[i].photo_url+"' alt='' class='img-responsive' width='100px' height='100px;'>",
                        data_list[i].company_name,
                        data_list[i].email,
                        data_list[i].phone,
//                        data_list[i].facebook_url,
                        '<a href="'+data_list[i].facebook_url+'" target="_blank" class="fab fa-facebook-square fa-2x ml-5"></a>',
                        '<a href="'+data_list[i].website_url+'" target="_blank" class="fab fa-internet-explorer fa-2x ml-5"></a>',
//                        data_list[i].address,
//                        data_list[i].location,
                        action,

                    ] ).draw( false );

                }
            }

            $('#update_form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'post',
                    url: '{{url("edit_company_data")}}',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
//                        console.log(result);
                        load_pending_data();
                        load_activated_data("all_company");
                        $('#myModal_edit').modal('hide');
                        $('#update_photo_new').val("");
                    },
                });
            });
            delete_company=function(id) {
                var result=window.confirm("Are You Sure To Delete!");
                if(result){
                    $.ajax({
                        type: 'post',
                        url: '../delete_company/'+id,
                        // data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
//                        alert(data_return);
                            load_pending_data();
                            load_activated_data("all_company");
                        },
                    });
                }
            }

            activate_company=function(id) {
                var result=window.confirm("Are You Sure To Activate!");
                if(result){
                    $.ajax({
                        type: 'post',
                        url: '../activate_pending_company/'+id,
                        // data:"id="+id,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(data_return) {
//                        alert(data_return);
                            load_pending_data();
                            load_activated_data("all_company");
                        },
                    });
                }
            }

            ban_company=function(id,data) {
                $.ajax({
                    type: 'post',
                    url: '../api/company_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        data_return=JSON.parse(data_return);
//                        console.log(data_return.is_top_company);
                        if(data_return.is_top_company===false){
                            var result=window.confirm("Are You Sure!");
                            if(result){
                                $.ajax({
                                    type: 'post',
                                    url: '../ban_company/'+id+'/'+data,
                                    // data:"id="+id,
                                    cache:false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data_return) {
//                        console.log(data_return);
                                        load_pending_data();
                                        load_activated_data("all_company");
                                    },
                                });
                            }

                        }
                        else{
                            alert('Please Remove From TopCompany First to Bann This Company');
                        }

                    },
                });

            }

            top_company=function(id,data){
                $.ajax({
                    type: 'post',
                    url: '../api/company_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        data_return=JSON.parse(data_return);
                        if(data_return.status===1){
                            var result=window.confirm("Are You Sure!");
                            if(result){
                                $.ajax({
                                    type: 'post',
                                    url: '../top_company/'+id+'/'+data,
                                    // data:"id="+id,
                                    cache:false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data_return) {
                                        console.log(data_return);
                                        load_pending_data();
                                        load_activated_data("all_company");
                                    },
                                });
                            }
                        }
                        else{
                            alert('Please Unban First to Add TopCompany')
                        }

                    },
                });

            }

            detail_list=function(id) {
                $.ajax({
                    type: 'post',
                    url: '../api/company_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data=JSON.parse(data_return);
                        console.log(data);
                        $('#view_company_name').html(data.company_name);
                        $('#view_company_type').html(data.type);
                        $('#view_address').html(data.address);
                        $('#view_description').html(data.description);
                        $('#view_vision_and_mission').html(data.vision_and_mission);
                        $('#view_what_we_do').html(data.what_we_do);
                        $('#view_why_join_us').html(data.why_join_us);
                        $('#view_location').html(data.location);
                        document.getElementById("view_company_logo").src=data.photo_url;
                        document.getElementById("view_email").href=data.email;
                        document.getElementById("view_phone").href=data.phone;
                        if(data.verify===0){
                            document.getElementById("company_link").style.display="none";
                        }
                        else{
                            document.getElementById("company_link").style.display="block";
                        }

                        document.getElementById("link_company_dashboard").href=data.domain_url+"../../../admin/login_company_account/"+data.id;
                        document.getElementById("link_company_profile").href=data.domain_url+"../../../company_profile/"+data.id;

                        document.getElementById("view_facebook_url").href=data.facebook_url;
                        document.getElementById("view_website_url").href=data.website_url;
                        $('#view_email').html(data.email);
                        $('#view_phone').html(data.phone);
                        $('#myModal_view').modal('show');
//                            load_data();
                    },
                });
            }

            edit_list=function(id) {
                $.ajax({
                    type: 'post',
                    url: '../api/company_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data=JSON.parse(data_return);
                        console.log(data);
                        $('#company_id').val(data.id);
                      $('#company_name_edit_box').html(data.company_name);
                      $('#company_type_edit_box').html(data.type);
                        if(data.type==="free"){
                            $('.edit_company_type')[0].checked="checked";
                        }
                        else{
                            $('.edit_company_type')[1].checked="checked";
                        }
                        $('#edit_company_name').val(data.company_name);
                        $('#edit_company_address').val(data.address);
                        $('#edit_company_description').val(data.description);
                        $('#edit_vision_and_mission').val(data.vision_and_mission);
                        $('#edit_what_we_do').val(data.what_we_do);
                        $('#edit_why_join_us').val(data.why_join_us);
                        $('#edit_facebook_url').val(data.facebook_url);
                        $('#edit_website_url').val(data.website_url);
                        $('#edit_company_email').val(data.email);
                        $('#edit_company_phone').val(data.phone);
                        $('#image_edit_box').attr('src',data.photo_url);

                        var option_location=document.getElementsByClassName("edit_location");
                        for (var i=0;i<option_location.length;i++){
                            if(option_location[i].innerHTML===data.location){
                                option_location[i].setAttribute('selected','');
                                console.log(i);
                            }
                        }
                        $('#myModal_edit').modal('show');
//                            load_data();
                    },
                });
            }

            change_company_data=function (data) {
                load_activated_data(data);
//                alert(data);
            }

        });

    </script>
@endsection