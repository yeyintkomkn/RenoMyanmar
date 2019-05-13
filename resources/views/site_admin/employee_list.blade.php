@extends('layouts.site_admin.site_admin_design')
@section('css')
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

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
        .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
        }

        .color input{ background-color:#f1f1f1;}

        #myModal_edit input,
        #myModal_edit textarea{
            border: 1px solid #ccc!important;
        }
        #myModal_edit label{
            font-size: 20px;
            font-family: times;
            color: #800080;
        }

    </style>



@endsection
@section('nav_bar_text')
    Employee List
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Requested Employee</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        {{--<th>BudgetRange</th>--}}
                                        {{--<th>Category_arr</th>--}}
                                        {{--<th>ProjectType_arr</th>--}}
                                        {{--<th>StartDate</th>--}}
                                        {{--<th>CurrentSituation</th>--}}
                                        {{--<th>Note</th>--}}
                                        {{--<th>File</th>--}}
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" value=" {{$i=1}}">
                                    @foreach($employee as $data)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$data->username}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->address}}</td>
                                            <td>{{$data->created_at}}</td>
                                            {{--<td>BudgetRange</td>--}}
                                            {{--<td>Category_arr</td>--}}
                                            {{--<td>ProjectType_arr</td>--}}
                                            {{--<td>StartDate</td>--}}
                                            {{--<td>CurrentSituation</td>--}}
                                            {{--<td>Note</td>--}}
                                            {{--<td>File</td>--}}
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="show_detail_model({{$data->id}})">Detail</button>
                                                <a href="{{url('admin/employee/delete/'.$data->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal_employee">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="employee_name"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

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
                                        <a href="" target="_blank" data-toggle='tooltip' title="Click now!" id="employee_email"></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="file_email">
                                        <i class="fas fa-phone fa-2x"></i>
                                        <h3>
                                            Phone
                                        </h3>
                                        <a href="" data-toggle='tooltip' title="Click now!" id="employee_phone"></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="file_email">
                                        <i class="fas fa-home fa-2x"></i>
                                        <h3>
                                            Adderss
                                        </h3>
                                        <p id="employee_address">

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <hr>

                            <div>
                                <h3>
                                    Budget range
                                </h3>
                                <p id="employee_budget">

                                </p>
                            </div>
                            <hr>
                            {{--<div>--}}
                                {{--<h3>--}}
                                    {{--Service type--}}
                                {{--</h3>--}}
                                {{--<p id="employee_service_type">--}}

                                {{--</p>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            {{--<div>--}}
                                {{--<h3>--}}
                                    {{--Project type--}}
                                {{--</h3>--}}
                                {{--<p id="employee_project_type">--}}

                                {{--</p>--}}
                            {{--</div>--}}

                            {{--<hr>--}}
                            <div>
                                <h3>
                                    Expected project start date
                                </h3>
                                <h6>
                                    {{--<span class="text-muted"><i class="far fa-clock"></i> 12:20:60s |</span>--}}

                                    <span class="text-muted"><i class="far fa-calendar-alt"></i> <span id="employee_start_date"></span></span>
                                </h6>
                            </div>

                            <hr>
                            <div>
                                <h3>
                                    Current situation
                                </h3>
                                <p id="employee_current_situation">

                                </p>
                            </div>

                            <hr>
                            <div>
                                <h3>
                                    Briet description
                                </h3>
                                <p id="employee_description">

                                </p>
                            </div>
                            <hr>
                            <div id="file_ui">
                                <h3>
                                    File
                                </h3>
                                <p>
                                    <a href="#" target="_blank" id="attach_file" class="btn btn-danger text-white">Attach File</a>
                                </p>
                            </div>
                            {{--<div>--}}
                            {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Facebook" data-placement="bottom"><i class="fab fa-facebook fa-lg"></i></a>--}}
                            {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Website" data-placement="bottom"><i class="fab fa-chrome fa-lg"></i></i></a>--}}
                            {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Twitter" data-placement="bottom"><i class="fab fa-twitter fa-lg"></i></i></a>--}}
                            {{--<a href="https://www.facebook.com/allinoneNESW/" target="_blank" data-toggle='tooltip' title="Google plus" data-placement="bottom"><i class="fab fa-google-plus fa-lg"></i></i></a>--}}
                            {{--</div>--}}

                            <hr>

                            <div class="table-responsive">
                                <table id="company_datatable" class="table">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th width="50px">No</th>
                                            <th width="150px">Company</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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



@endsection



@section('js')

    <script src="{{url('js/admin_js/plugins/jquery.dataTables.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //        function ajax_set_admin_data()

        $(document).ready(function() {

            $("#datatable").DataTable({
//                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });
            var company_datatabel=$("#company_datatable").DataTable({
//                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });

            show_detail_model=function(id){
                $.ajax({
                    type: 'post',
                    url: '../company/get_employee_detail/'+id,
                    // data:"id="+id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data_return) {
                        var data=JSON.parse(data_return);
                        console.log(data);
                        $('#employee_name').html(data.username);
                        $('#employee_address').html(data.address);
                        $('#employee_budget').html(data.budget_range);
//                       $('#employee_service_type').html(data.username);
//                       $('#employee_project_type').html(data.username);
                        $('#employee_start_date').html(data.start_date);
                        $('#employee_current_situation').html(data.current_situation);
                        $('#employee_description').html(data.note);

                        $('#employee_email').html(data.email);
                        $('#employee_phone').html(data.phone);
                        if(data.attach_file[data.attach_file.length-1]==='/'){
                            document.getElementById('file_ui').style.display="none";
                        }
                        document.getElementById('attach_file').href=data.attach_file;
                        var no=1;
//                        console.log("company="+data.requested_companies[0].id);

                        for(var i=0;i<data.requested_companies.length;i++){
                            company_datatabel.row.add( [
                                //var company_page=;
                                (no++),
                                "<img src='"+data.requested_companies[i].photo_url+"' alt='' class='img-responsive' width='100px' height='100px;'>",
                                '<a href="'+data.requested_companies[i].domain_url+'../../../company_profile/'+data.requested_companies[i].id+'" target="_blank">'+data.requested_companies[i].company_name+'</a>'
//                                '<img src="'+data.requested_companies[i]+'">',`My name is ${person.name}.`


                            ] ).draw( false );
                        }




                        $('#myModal_employee').modal('show');
//                            load_data();
                    },
                });
            }


        });
    </script>
@endsection