<!DOCTYPE html>
<html lang="en">

<head>
    <title>Matrix Admin</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/matrix-login.css')}}" />
    <link href="{{asset('font-awesome/css/backend_css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="loginbox">
    @if(Session::has('error_msg'))
        <p class="alert alert-danger">{{ session('error_msg') }}</p>

    @endif

    @if(Session::has('success_msg'))
        <p class="alert alert-success">{{ session('success_msg') }}</p>

    @endif
    <form id="loginform" method="post" class="form-vertical" action="{{url('add_sub_category')}}">
        {{csrf_field()}}

        <div class="control-group normal_text"> <h3><img src="{{asset('images/backend_images/logo.png')}}" alt="Logo" /></h3></div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                    <select name="main_category_id">
                        @foreach($main_categories as $main_category)
                        <option value="{{$main_category['id']}}">{{$main_category['category_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                    <input type="text" name="category_name" placeholder="CategoryName" />
                </div>
            </div>
        </div>

        <div class="form-actions">
            {{--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>--}}
            <span class="pull-right"><input type="submit" value="Add" class="btn btn-success" /></span>
        </div>
    </form>

</div>

<script src="{{asset('js/backend_js/jquery.min.js')}}"></script>
<script src="{{asset('js/backend_js/matrix.login.js')}}"></script>
</body>

</html>
