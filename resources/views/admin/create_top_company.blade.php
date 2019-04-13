{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.adminLayout.admin_design')
@section('content')
    <!--main-container-part-->
    <div id="content">

        <form action="{{url('create_top_company')}}" method="post">
            {{csrf_field()}}
            @foreach($companies as $company)
                <input  type="checkbox" name="company_id[]" value="{{$company['id']}}">{{$company['company_name']}} <br>
                @endforeach


            <input  type="submit" value="Create">
        </form>

    </div>

    <!--end-main-container-part-->
@endsection