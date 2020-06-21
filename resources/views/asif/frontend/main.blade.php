@extends('asif.frontend.master')
@section('content')
    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner slide-inner1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Amazing Pure Nature Hohey</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner7">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Amazing Pure Nature Coconut Oil</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner8">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Amazing Pure Nut Oil</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">

                        @foreach($feature as $items)

                        <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{url('public/feature_image/'.$items->image)}}" alt="">
                                <div class="featured-content">
                                    <a href="{{route('shop')}}">{{$items->name}}</a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>



    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>

                        <img src="{{url('public/ecom/images/section-title.png')}}" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">

                @foreach(App\billings::OrderBy('product_quantity','desc')->get() as $sale)
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">


                        <div class="product-img">
                            <img src="{{url('public/img/thumbnail/'.$sale->product->product_thumbnail)}}" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{$sale->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('singlewishlist',$sale->id)}}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{route('SingleCart',$sale->id)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="">{{$sale->product->product_name}}</a></h3>
                            <p class="pull-left">${{$sale->product_price}}

                            </p>
                            <ul class="pull-right d-flex">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="{{url('public/ecom/images/section-title.png')}}" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach($product as $key => $item )
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12 @if($key >3) moreload @endif">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{url('/public/img/thumbnail')}}/{{$item->product_thumbnail}}" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('singlewishlist',$item->id)}}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{route('SingleCart',$item->id)}}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{url('/item')}}/{{$item->slug}}">{{$item->product_name}}</a></h3>
                            <p class="pull-left">${{$item->product_price}}

                            </p>
                            <ul class="pull-right d-flex">

                                @if($item->star<=0)
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>

                                    @elseif($item->star==1)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>

                                @elseif($item->star==2)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                @elseif($item->star==3)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                @elseif($item->star==3.5)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-half-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                @elseif($item->star==4)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                @elseif($item->star==4.5)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-half-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                @elseif($item->star==5)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                  @endif
                            </ul>
                        </div>
                    </div>
                </li>


                    <!-- Modal area start -->
                    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body d-flex">
                                    <div class="product-single-img w-50">
                                        <img src="{{url('/public/img/thumbnail')}}/{{$item->product_thumbnail}}" alt="{{$item->product_name}}">
                                    </div>
                                    <div class="product-single-content w-50">
                                        <h3>{{$item->product_name}}</h3>
                                        <div class="rating-wrap fix">
                                            <span class="pull-left">${{$item->product_price}}</span>
                                            <ul class="rating pull-right">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li>(05 Customar Review)</li>
                                            </ul>
                                        </div>
                                        <p>{{$item->product_summary}}</p>
                                        <ul class="input-style">
                                            <li class="quantity cart-plus-minus">
                                                <input type="text" value="1" />
                                            </li>
                                            <li><a href="cart.html">Add to Cart</a></li>
                                        </ul>
                                        <ul class="cetagory">
                                            <li>Categories:</li>
                                            <li><a href="#">{{$item->get_category->name}}</a></li>
                                        </ul>
                                        <ul class="socil-icon">
                                            <li>Share :</li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal area start -->

              @endforeach
                    <li class="col-12 text-center">
                        <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                    </li>
            </ul>
        </div>
    </div>



    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{url('public/ecom/images/test/1.png')}}" alt="">
                            </div>
                        </div>
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{url('public/ecom/images/test/1.png')}}" alt="">
                            </div>
                        </div>
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{url('public/ecom/images/test/1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->

    @endsection