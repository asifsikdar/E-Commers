<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$title ?? "IAWD E-Commerce"}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{url('public/ecom/images/favicon.png')}}">

    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/bootstrap.min.css')}}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/owl.carousel.min.css')}}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/font-awesome.min.css')}}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/flaticon.css')}}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/jquery-ui.css')}}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/ecom/css/swiper.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/styles.css')}}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('public/ecom/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('public/ecom/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
<!--Start Preloader-->
<div class="preloader-wrap">
    <div class="spinner"></div>
</div>
<!-- search-form here -->
<div class="search-area flex-style">
    <span class="closebar">Close</span>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-12">
                <div class="search-form">
                    <form action="#">
                        <input type="text" placeholder="Search Here...">
                        <button><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- search-form here -->
<!-- header-area start -->
<header class="header-area">
    <div class="header-top bg-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <ul class="d-flex header-contact">
                        @foreach(\App\WebInfo::all() as $value)
                        <li><i class="fa fa-phone"></i>{{$value->phone}}</li>
                        <li><i class="fa fa-envelope"></i>{{$value->email}}</li>
                            @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <ul class="d-flex account_login-area">
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown_style">
                                @auth
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="{{route('wishlist')}}">wishlist</a></li>
                                @else
                                    <li><a href="{{url('/login')}}">Login</a></li>
                                    <li><a href="{{url('/register')}}">Register</a></li>
                                    @endauth
                            </ul>
                        </li>
                        @auth
                        <li><a href="{{url('/home')}}">Home </a></li>
                        @else
                        <li><a href="{{url('/register')}}">Register </a></li>
                            @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="fluid-container">
            <div class="row">
                <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                    <div class="logo">
                        <a href="index.html">
                            <img src="public/ecom/images/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <nav class="mainmenu">
                        <ul class="d-flex">
                            <li class="active"><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{route('about')}}">About</a></li>
                            <li>
                                <a href="{{route('shop')}}">Shop</a>
                            </li>
                            <li>
                                <a href="{{route('Cart')}}">Cart</a>
                            </li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <form action="{{route('cheakout')}}"> </form>
                <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                    <ul class="search-cart-wrapper d-flex">
                        <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                        <li>
                            @php
                                $sum1=0;
                            @endphp
                            @php
                            $count1=App\Wishlist::OrderBy('product_id','asc')->count()
                            @endphp
                            <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{$count1}}</span></a>
                            <ul class="cart-wrap dropdown_style">
                                @foreach(App\Wishlist::OrderBy('product_id','asc')->get() as $Wishes)
                                <li class="cart-items">
                                    <div class="cart-img">
                                        <img src="{{url('/public/img/thumbnail/'.$Wishes->product->product_thumbnail)}}" alt="" width="50px">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{url('/item')}}/{{$Wishes->product->slug}}">{{$Wishes->product->product_name}}</a>
                                        <span>QTY : {{$Wishes->product_quantity}}</span>
                                        <p>${{$Wishes->product->product_price}}</p>
                                        @php
                                            $sum1 += $Wishes->product->product_price * $Wishes->product_quantity;
                                        @endphp
                                        <i class="fa fa-times"></i>
                                    </div>
                                </li>
                                @endforeach
                                <li>Subtotol: <span class="pull-right">{{$sum1}}</span></li>
                                <li>
                                    <button class="button Button"><a style="color: black" href="{{route('cheakout')}}">CheckOut</a></button>
                                </li>
                            </ul>
                        </li>
                        @php
                            $sum=0;
                        @endphp
                        {{--@php--}}
                        {{--$count=0;--}}
                        {{--@endphp--}}
                        <li>
                         @php
                         $count=App\cart::OrderBy('product_id','asc')->count();
                         @endphp
                            <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{$count}}</span></a>
                            {{--@endforeach--}}
                            <ul class="cart-wrap dropdown_style">
                               @foreach(App\cart::OrderBy('id','asc')->get() as $cart)
                                <li class="cart-items">
                                    <div class="cart-img">
                                        <img src="{{url('public/img/thumbnail/'.$cart->product->product_thumbnail)}}" alt="" width="50px">
                                    </div>
                                    <div class="cart-content">
                                        <a href="{{url('/cart')}}">{{$cart->product->product_name}}</a>
                                        <span>QTY : {{$cart->product_quantity}}</span>
                                        <p>${{$cart->product->product_price}}</p>
                                        @php
                                            $sum += $cart->product->product_price * $cart->product_quantity;
                                        @endphp
                                        <i class="fa fa-times"></i>
                                    </div>
                                </li>
                                @endforeach
                                <li>Subtotal: <span class="pull-right">{{$sum}}</span></li>
                                <li>
                                    <button class="button Button"><a style="color: black" href="{{route('cheakout')}}">CheckOut</a></button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                    <div class="responsive-menu-tigger">
                        <a href="javascript:void(0);">
                            <span class="first"></span>
                            <span class="second"></span>
                            <span class="third"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- responsive-menu area start -->
        <div class="responsive-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-block d-lg-none">
                        <ul class="metismenu">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="{{route('about')}}">About</a></li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                <ul aria-expanded="false">
                                    <li><a href="shop.html">Shop Page</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                <ul aria-expanded="false">
                                    <li><a href="{{route('about')}}">About Page</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items">
                                <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                <ul aria-expanded="false">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- responsive-menu area start -->
    </div>
</header>
<!-- header-area end -->

@yield('content')
<!-- .footer-area start -->

<div class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="footer-top-item">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="footer-top-text text-center">
                            <ul>
                                <li><a href="home.html">home</a></li>
                                <li><a href="#">our story</a></li>
                                <li><a href="#">feed shop</a></li>
                                <li><a href="blog.html">how to eat blog</a></li>
                                <li><a href="contact.html">contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-12">
                    <div class="footer-icon">
                        <ul class="d-flex">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-12">
                    <div class="footer-content">
                        @foreach(\App\WebInfo::all() as $webinfo )
                        <p>{{$webinfo->description}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8 col-sm-12">
                    <div class="footer-adress">
                        <ul>
                            <li><a href="#"><span>Email:</span>{{$webinfo->email}}</a></li>
                            <li><a href="#"><span>Tel:</span> {{$webinfo->telphone}}</a></li>
                            <li><a href="#"><span>Adress:</span>{{$webinfo->Address}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="footer-reserved">
                        <ul>
                            <li>{{$webinfo->copyright}}.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- .footer-area end -->

<!-- jquery latest version -->
<script src="{{asset('public/ecom/js/vendor/jquery-2.2.4.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('public/ecom/js/bootstrap.min.js')}}"></script>
<!-- owl.carousel.2.0.0-beta.2.4 css -->
<script src="{{asset('public/ecom/js/owl.carousel.min.js')}}"></script>
<!-- scrollup.js -->
<script src="{{asset('public/ecom/js/scrollup.js')}}"></script>
<!-- isotope.pkgd.min.js -->
<script src="{{asset('public/ecom/js/isotope.pkgd.min.js')}}"></script>
<!-- imagesloaded.pkgd.min.js -->
<script src="{{asset('public/ecom/js/imagesloaded.pkgd.min.js')}}"></script>
<!-- jquery.zoom.min.js -->
<script src="{{asset('public/ecom/js/jquery.zoom.min.js')}}"></script>
<!-- countdown.js -->
<script src="{{asset('public/ecom/js/countdown.js')}}"></script>
<!-- swiper.min.js -->
<script src="{{asset('public/ecom/js/swiper.min.js')}}"></script>
<!-- metisMenu.min.js -->
<script src="{{asset('public/ecom/js/metisMenu.min.js')}}"></script>
<!-- mailchimp.js -->
<script src="{{asset('public/ecom/js/mailchimp.js')}}"></script>
<!-- jquery-ui.min.js -->
<script src="{{asset('public/ecom/js/jquery-ui.min.js')}}"></script>
<!-- main js -->
<script src="{{asset('public/ecom/js/scripts.js')}}"></script>
@yield('footer_js')
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
