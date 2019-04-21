<!-- Footer Section Start -->
<footer class="footer">
    <div class="row lg-menu">
        <div class="container">

            <div class="col-md-4 col-sm-4">
                <img src="{{asset('images/frontend_images/reno_myanmar_footer.png')}}" class="img-responsive" alt="" />
            </div>

            <div class="col-md-8 co-sm-8 pull-right">
                <ul>
                    <li><a href="{{url('/')}}" title="">Home</a></li>
                    <li><a href="{{url('/blog')}}" title="">News</a></li>
                    <li><a href="{{url('contact')}}" title="">Contact Us</a></li>
                    <li><a href="{{url('about')}}" title="">About Us</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row no-padding">
        <div class="container">
            <div class="col-md-3 col-sm-12">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">About Us</h3>
                    <div class="textwidget">
                        <p>{{substr($site_profile->about_us,0,100)}}</p>
                        <p><strong>Address:</strong>{{$site_profile->address}}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{$site_profile->email}}">{{$site_profile->email}}</a></p>
                        <p><strong>Call:</strong> <a href="tel:{{$site_profile->phone}}">{{$site_profile->phone}}</a></p>
                        <ul class="footer-social">
                            <li><a href="{{$site_profile->facebook}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{$site_profile->google}}"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{{$site_profile->twitter}}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{$site_profile->instragram}}"><i class="fa fa-instagram"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Main Categories</h3>
                    <div class="textwidget">
                        <div class="textwidget">
                            <ul class="footer-navigation">
                                @foreach($main_categories as $data)
                                    <li><a href="{{url('main_category_company/'.$data->id)}}" title="">{{$data->category_name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Latest News</h3>
                    <div class="textwidget">
                        <ul class="footer-navigation" id="show_news">
                            @foreach($latest_blog as $data)
                            <li style="padding-top: 3px;padding-bottom: 3px;"><a href="{{url('blog_detail/'.$data['id'])}}" title="">{{$data['title']}}</a></li>
                                @endforeach

                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Connect Us</h3>
                    <div class="textwidget">
                        <form class="footer-form">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                            <input type="text" class="form-control" placeholder="Email" required>
                            <textarea class="form-control" placeholder="Message"></textarea>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row copyright">
        <div class="container">
            <p>Copyright Reno Myanmar &copy; <?php echo date('Y'); ?>. <a>Design</a> by <a href="#">Green Hackers</a> </p>
        </div>
    </div>
</footer>

<div class="clearfix"></div>
<!-- Footer Section End -->

<!-- Sign Up Window Code -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#login" role="tab" data-toggle="tab">Sign In</a></li>
                        <li role="presentation"><a href="#register" role="tab" data-toggle="tab">Sign Up</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="myModalLabel2">
                        <div role="tabpanel" class="tab-pane fade in active" id="login">
                            <img src="{{asset('images/frontend_images/reno_myanmar.png')}}" class="img-responsive" alt="" />
                            <div class="subscribe wow fadeInUp">
                                @if(Session::has('error_msg'))
                                    <p style="color: red" class="col-sm-12">{{ session('error_msg') }}</p>

                                @endif

                                @if(Session::has('success_msg'))
                                    <p style="color: green" class="col-sm-12">{{ session('success_msg') }}</p>

                                @endif
                                <form action="{{url('login')}}" class="form-inline" method="post">
                                    {{csrf_field()}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="email"  name="email" class="form-control" placeholder="Email" required autofocus>
                                            <input type="password" name="password" class="form-control"  placeholder="Password" required="">
                                            <div class="center">
                                                <button type="submit" id="login-btn" class="submit-btn"> Login </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="register">
                            <img src="{{asset('images/frontend_images/reno_myanmar.png')}}" class="img-responsive" alt="" />
                            <form action="{{url('register')}}" class="form-inline" method="post">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{csrf_field()}}
                                        <input type="text"  name="company_name" class="form-control" placeholder="Company Name" required="">
                                        <input type="tel"  name="phone" class="form-control" placeholder="Phone number" required="">
                                        <input type="email"  name="email" class="form-control" placeholder="Email" required="">
                                        <input type="password" name="password" class="form-control"  placeholder="Password" required="">

                                        <input type="password" name="retype_password" class="form-control"  placeholder="Retype-Password" required="">
                                        <div class="text-center">
                                            <input type="checkbox" required id="agree"> <label for="agree">I have read and agree Team and Privicy Policy.</label>
                                        </div>
                                        <div class="center">
                                            <button type="submit" id="subscribe" class="submit-btn"> Create Account </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sign Up Window -->









<!-- <button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()"><i class="spin fa fa-cog" aria-hidden="true"></i></button> -->
<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
    <ul id="styleOptions" title="switch styling">
        <li>
            <a href="javascript: void(0)" class="cl-box blue" data-theme="colors/blue-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box red" data-theme="colors/red-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box purple" data-theme="colors/purple-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box green" data-theme="colors/green-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box dark-red" data-theme="colors/dark-red-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box orange" data-theme="colors/orange-style"></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box sea-blue" data-theme="colors/sea-blue-style "></a>
        </li>
        <li>
            <a href="javascript: void(0)" class="cl-box pink" data-theme="colors/pink-style"></a>
        </li>
    </ul>
</div>

<div class="scroll_top" data-tooptip='web-link' title="Back to top"><i class="fa fa-angle-up"></i></div>