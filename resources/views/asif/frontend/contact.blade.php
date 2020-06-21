@extends('asif.frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Contact Us</h2>
                        <ul>
                            <li><a href="{{'/'}}">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- contact-area start -->
    <div class="google-map">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8332148993854!2d90.37696839888407!3d23.75332628451228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8ac20cff015%3A0xff2b5ccc3b603741!2sShukrabad%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1591010444141!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>        </div>
    </div>
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    @if(session('ContactData'))
                        <div class="alert alert-success" role="alert">
                            {{session('ContactData')}}
                        </div>
                    @endif
                   <form action="{{route('contactpost')}}" method="POST"></form>
                            @csrf
                    <div class="contact-form form-style">
                        <div class="cf-msg"></div>
                        {{--<form action="http://themepresss.com/tf/html/tohoney/mail.php" method="post" id="cf">--}}
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" placeholder="Name" id="fname" name="fname">
                                </div>
                                <div class="col-12  col-sm-6">
                                    <input type="text" placeholder="Email" id="email" name="email">
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Subject" id="subject" name="subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="contact-textarea" placeholder="Message" id="msg" name="msg"></textarea>
                                </div>
                                <li>
                                    <button class="button Button"><a style="color: black" href="{{route('contactpost')}}">Submit</a></button>
                                </li>
                            </div>
                        {{--</form>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap">
                        <ul>
                            @foreach(\App\WebInfo::all() as $value)
                            <li>
                                <i class="fa fa-home"></i> Address:
                                <p>{{$value->Address}}</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> Email address:
                                <p>
                                    <span>{{$value->email}}</span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> phone number:
                                <p>
                                    <span>{{$value->phone}}</span>
                                    <span>{{$value->telphone}}</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- contact-area end -->
    @endsection