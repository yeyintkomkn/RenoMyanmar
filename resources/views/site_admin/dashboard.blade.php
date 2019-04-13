@extends('layouts.site_admin.site_admin_design')

@section('css')
@endsection
@section('nav_bar_text')
    Dashboard
    @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats"  style="height: 125px;">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">playlist_add_check</i>
                            </div>
                            <p class="card-category">Active Companies</p>
                            <h3 class="card-title p-3">{{$active_company_count}}
                                {{--<small>GB</small>--}}
                            </h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons text-danger">warning</i>--}}
                                {{--<a href="#pablo">Get More Space...</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Free Companies</p>
                            <h3 class="card-title p-3">{{$free_company_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">date_range</i> Last 24 Hours--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">attach_money</i>
                            </div>
                            <p class="card-category">Paid Companies</p>
                            <h3 class="card-title">{{$paid_company_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">local_offer</i> Tracked from Github--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">info</i>
                            </div>
                            <p class="card-category">Pending Companies</p>
                            <h3 class="card-title">{{$pending_company_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                            {{--<div class="stats">--}}
                                {{--<i class="material-icons">update</i> Just Updated--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">block</i>
                            </div>
                            <p class="card-category">Ban Companies</p>
                            <h3 class="card-title">{{$ban_company_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                        {{--<div class="stats">--}}
                        {{--<i class="material-icons">local_offer</i> Tracked from Github--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">open_in_new</i>
                            </div>
                            <p class="card-category">Top Companies</p>
                            <h3 class="card-title">{{$top_company_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                        {{--<div class="stats">--}}
                        {{--<i class="material-icons">local_offer</i> Tracked from Github--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats" style="height: 125px;">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category">Total Employees</p>
                            <h3 class="card-title">{{$total_employee_count}}</h3>
                        </div>
                        {{--<div class="card-footer">--}}
                        {{--<div class="stats">--}}
                        {{--<i class="material-icons">local_offer</i> Tracked from Github--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-chart">
                        <div class="card-header">
                            <canvas id="myChart" width="300" style="height: 200px"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-center">Company By Sub Categories</h4>
                            {{--<p class="card-category">Last Campaign Performance</p>--}}
                        </div>
                        <div class="card-footer">
                            <div class="stats" id="label">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <canvas id="main_category_count" width="300" height="250"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">CompanyCount by Main Category</h4>
                            {{--<p class="card-category">--}}
                                {{--<span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>--}}
                        </div>
                        {{--<div class="card-footer">--}}
                            {{----}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <canvas id="main_category_percent" width="300" height="250"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">CompanyPercent by Main Category</h4>
                            {{--<p class="card-category">--}}
                            {{--<span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>--}}
                        </div>
                        {{--<div class="card-footer">--}}
                        {{----}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>





            {{--<div class="row">--}}
                {{--<div class="col-lg-6 col-md-12">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header card-header-tabs card-header-primary">--}}
                            {{--<div class="nav-tabs-navigation">--}}
                                {{--<div class="nav-tabs-wrapper">--}}
                                    {{--<span class="nav-tabs-title">Tasks:</span>--}}
                                    {{--<ul class="nav nav-tabs" data-tabs="tabs">--}}
                                        {{--<li class="nav-item">--}}
                                            {{--<a class="nav-link active" href="#profile" data-toggle="tab">--}}
                                                {{--<i class="material-icons">bug_report</i> Bugs--}}
                                                {{--<div class="ripple-container"></div>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li class="nav-item">--}}
                                            {{--<a class="nav-link" href="#messages" data-toggle="tab">--}}
                                                {{--<i class="material-icons">code</i> Website--}}
                                                {{--<div class="ripple-container"></div>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li class="nav-item">--}}
                                            {{--<a class="nav-link" href="#settings" data-toggle="tab">--}}
                                                {{--<i class="material-icons">cloud</i> Server--}}
                                                {{--<div class="ripple-container"></div>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<div class="tab-content">--}}
                                {{--<div class="tab-pane active" id="profile">--}}
                                    {{--<table class="table">--}}
                                        {{--<tbody>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="" checked>--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Sign contract for "What are conference organizers afraid of?"</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="">--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="">--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit--}}
                                            {{--</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="" checked>--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Create 4 Invisible User Experiences you Never Knew About</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="messages">--}}
                                    {{--<table class="table">--}}
                                        {{--<tbody>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="" checked>--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit--}}
                                            {{--</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="">--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Sign contract for "What are conference organizers afraid of?"</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="settings">--}}
                                    {{--<table class="table">--}}
                                        {{--<tbody>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="">--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="" checked>--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit--}}
                                            {{--</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<div class="form-check">--}}
                                                    {{--<label class="form-check-label">--}}
                                                        {{--<input class="form-check-input" type="checkbox" value="" checked>--}}
                                                        {{--<span class="form-check-sign">--}}
                                    {{--<span class="check"></span>--}}
                                  {{--</span>--}}
                                                    {{--</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>Sign contract for "What are conference organizers afraid of?"</td>--}}
                                            {{--<td class="td-actions text-right">--}}
                                                {{--<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">edit</i>--}}
                                                {{--</button>--}}
                                                {{--<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">--}}
                                                    {{--<i class="material-icons">close</i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-6 col-md-12">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-header card-header-warning">--}}
                            {{--<h4 class="card-title">Employees Stats</h4>--}}
                            {{--<p class="card-category">New employees on 15th September, 2016</p>--}}
                        {{--</div>--}}
                        {{--<div class="card-body table-responsive">--}}
                            {{--<table class="table table-hover">--}}
                                {{--<thead class="text-warning">--}}
                                {{--<th>ID</th>--}}
                                {{--<th>Name</th>--}}
                                {{--<th>Salary</th>--}}
                                {{--<th>Country</th>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>1</td>--}}
                                    {{--<td>Dakota Rice</td>--}}
                                    {{--<td>$36,738</td>--}}
                                    {{--<td>Niger</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2</td>--}}
                                    {{--<td>Minerva Hooper</td>--}}
                                    {{--<td>$23,789</td>--}}
                                    {{--<td>Curaçao</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>3</td>--}}
                                    {{--<td>Sage Rodriguez</td>--}}
                                    {{--<td>$56,142</td>--}}
                                    {{--<td>Netherlands</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>4</td>--}}
                                    {{--<td>Philip Chaney</td>--}}
                                    {{--<td>$38,735</td>--}}
                                    {{--<td>Korea, South</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

    @endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>--}}
<script>

    $.ajax({
        type: 'get',
        url: '{{url("admin/company_by_sub_category")}}',
        // data:"id="+id,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data_return) {
            var data=JSON.parse(data_return);
            var str="";
            for(var i=0;i<data[0].length;i++){
                if(i%10===0){
                    console.log('Yes'+ i);
                    str+="<br>";
                }
               str+=data[0][i]+",";
            }
           $('#label').html(str);
            var ctx = document.getElementById("myChart").getContext('2d');
            draw_chart(ctx,'bar',data[0],data[1],"#7FB3D5","white");
        },
    });

 $.ajax({
        type: 'get',
        url: '{{url("admin/company_by_main_category")}}',
        // data:"id="+id,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data_return) {
            var data=JSON.parse(data_return);
            var percent_chart_main = document.getElementById("main_category_percent").getContext('2d');

            var count_chart_main = document.getElementById("main_category_count").getContext('2d');
            draw_main_categroy_chart(count_chart_main,'pie',data[0],data[1],"white","red");
            draw_chart(percent_chart_main,'bar',data[0],data[2],"white","red");
        },
    });

    function draw_chart(chart,chart_type,label,data,bgcolor,bordercolor) {
        var myChart = new Chart(chart, {
            type: chart_type,
            data: {
                labels: label,
                datasets: [{
                    label: '#Categories',
                    data: data,
                    backgroundColor: bgcolor,
                    borderColor: bordercolor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }

    function draw_main_categroy_chart(chart,chart_type,label,data,bgcolor,bordercolor) {
        var myChart = new Chart(chart, {
            type: chart_type,
            data: {
                labels: label,
                datasets: [{
                    label: '#Categories',
                    data: data,
                    backgroundColor: ['#ABEBC6','#D7BDE2','#AF7AC5  '],
                    borderColor: bordercolor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }

</script>
    @endsection