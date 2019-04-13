
{{--@extends('layouts.adminLayout.admin_design')--}}
@extends('layouts.userLayout.user_design')


@section('css')

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <style>
        a{
            text-decoration: none!important;
        }
        .widge a{
            color: #000;
            text-decoration: none;
        }
        .widge a:hover{
            opacity: 0.8;
        }
        .list-inline a{
            color: #777;
        }
        .list-inline a:hover{
            opacity: 0.8;
        }
        .well{
            background: #fff!important;
        }
        .mt-top{
            position: relative;
            top: -100px!important;
        }

    </style>
@endsection
@section('content')
    <!-- This is online banner radom photo -->
    <img src="{{asset('images/frontend_images/page_banner_2.jpg')}}" width="100%"  alt="photo" class="img-fluid">

    <section>
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.3606154133395!2d96.17065531430852!3d16.808456988428013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDQ4JzMwLjUiTiA5NsKwMTAnMjIuMiJF!5e0!3m2!1sen!2smm!4v1541403031428" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>

    <section id="contact-us-main">
        <div class="container">
            <div class="well">
                <div class="well-header">
                    <h3>
                        Contact Us
                    </h3>
                </div>



                <form action="{{url('contact')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group contact-group">
                                <input type="text" class="form-control" id="personname" placeholder="Name*" name="name" required>
                            </div>
                            <div class="form-group contact-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email*" required>
                            </div>
                            <div class="form-group contact-group">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone*" required>
                            </div>
                            <div class="form-group contact-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject*" required>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control message" name="message" rows="8" style="margin-top:-5px;" placeholder="Message"><?php if (isset($message)) {echo $message;} ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="g-recaptcha" data-sitekey="6Ld6h3oUAAAAAK8fzZL0nquTYw-h5T3tfUaZWX2N"></div>
                                    <br>
                                    <span class="help-block" style="display: none;">Please check that you are not a robot.</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="help-block" style="display: none;">Please enter a the security code.</span>
                                    <input type="hidden" name="pgsubmitted" value="pgsubmitted" />
                                    <button type="submit" class="btn btn-search btn-success pull-right">Send Massage</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h3>
                                Address
                            </h3>
                            <p>
                                <i class="fa fa-map-marker fa-lg"></i>  No (62), Shwe Hin Thar (2 ) street, (11)Quarter, Hlaing Township, Yangon, Myanmar.
                            </p>
                            <h3>
                                Phone
                            </h3>
                            <p>
                                <i class="fa fa-phone ph fa-lg"></i>  01-538808 , 09-421169969 , 09-796453590
                            </p>
                            <h3>
                                Email
                            </h3>
                            <p>
                                <i class="fa fa-envelope-o env"></i> <a href="mailto:sales@2ktechengineering.com" id="envelope"> sales@2ktechengineering.com</a><br>
                            </p>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </section>

@endsection
