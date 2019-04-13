
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')


@section('css')
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat');
    #pandind_design{
        height: 100vh;
        background-image: url(https://images.unsplash.com/photo-1486685699329-4ab98114e509?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    #pandind_design .panding_text{
        margin-top: 50px;
        padding: 30px;
        background-color: rgba(100,220,0,0.7);
        box-shadow: 0px 0px 10px #000;
        border-radius: 0px 50px 0px 50px;
    }
    #pandind_design .panding_text h1{
        font-family: 'Montserrat', sans-serif;
        color: #fff;
    }
    #pandind_design .panding_text .pand_underline{
        width: 100px;
        height: 3px;
        background-image: linear-gradient(90deg,#fff,transparent);
        margin-bottom: 20px;
    }
    #pandind_design .panding_text .pandinng_underline_text{
        color: #ddd;
        line-height: 28px;
        font-size: 17px;
    }
</style>
@endsection
@section('content')
    <section id="pandind_design">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 pt-5">
                    <div class="panding_text">
                        <h1>
                            @if(Session::has('msg_title'))
                                {{ session('msg_title') }}
                                @endif
                           {{--{{$msg_title}}--}}

                        </h1>
                        <div class="pand_underline"></div>
                        <p class="pandinng_underline_text">
                            @if(Session::has('msg'))
                                {{ session('msg') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
