<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('images/admin_image//sidebar-1.jpg')}}">
    <div class="logo">
        <a href="{{url('company_profile/'.$company_profile['id'])}}" target="_blank" class="simple-text logo-normal">
            {{$company_profile['company_name']}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item @if($url=="dashboard") active @endif">
                <a class="nav-link" href="{{url('company/company_dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item @if($url=="company_profile") active @endif">
                <a class="nav-link" href="{{url('company/company_profile')}}">
                    <i class="material-icons">edit</i>
                    <p>Company Profile</p>
                </a>
            </li>
            <li class="nav-item @if($url=="photo") active @endif">
                <a class="nav-link" href="{{url('company/photo')}}">
                    <i class="material-icons">photo</i>
                    <p>Photo</p>
                </a>
            </li>
            <li class="nav-item @if($url=="feedback") active @endif">
                <a class="nav-link" href="{{url('company/company_feedback')}}">
                    <i class="material-icons">feedback</i>
                    <p>Feedback</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('logout')}}">
                    <i class="material-icons">logout</i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>