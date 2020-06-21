
<style type="text/css">

    .Couponbutton{
        width: 150px;
        height: 45px;
        position: absolute;
        right: 0;
        top: 0;
        background: #ef4836;
        color: #fff;
        text-transform: uppercase;
        border: none;
        line-height: 50px;

    }

    .Couponbutton:hover{
        background: #333;
        cursor: pointer;
    }


    .hovere{
        color:green;
    }

    .hovere:hover span {display: none}

    .hovere:hover:before{content: 'replay!'}


</style>
@extends('asif.frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session('CartDelete'))
                    <div class="alert alert-danger" role="alert">
                       {{session('CartDelete')}}
                    </div>
                    @endif
                    @if(session('UpdateData'))
                        <div class="alert alert-success" role="alert">
                            {{session('UpdateData')}}
                        </div>
                    @endif
                    <form action="{{route('CartUpdate')}}" method="post">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $total=0;
                            @endphp
                            @forelse($carts as $cart)
                                <input type="hidden" value="{{$cart->id}}" name="cart_id[]">
                            <tr>
                                <td class="images"><img src="{{url('public/img/thumbnail/'.$cart->product->product_thumbnail)}}" alt=""></td>
                                <td class="product"><a href="#">{{$cart->product->product_name}}</a></td>
                                <td class="ptice">{{$cart->product->product_price}}</td>
                                <td class="quantity cart-plus-minus">
                                    <input type="text" name="product_quantity[]" value="{{$cart->product_quantity}}">
                                </td>
                               @php
                                   $total += $cart->product->product_price * $cart->product_quantity;
                               @endphp
                                <td class="total">${{$cart->product->product_price * $cart->product_quantity}}</td>
                                <td class="remove" data-id="{{$cart->id}}"><a href="#"><i class="fa fa-times"></i></a></td>
                                {{--{{route('SingleCartDelete',$cart->id)}}--}}
                            </tr>
                            @empty
                                <tr>
                                    <td>you haven't cart any item</td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{route('shop')}}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        {{--@if(session('CouponData'))--}}
                                            {{--<div class="alert alert-success" role="alert">--}}
                                                {{--{{session('CouponData')}}--}}
                                            {{--</div>--}}
                                        {{--@endif--}}

                                        @php

                                        use Carbon\Carbon;

                                        @endphp

                                        @foreach(App\Coupon::get() as $item)

                                        @endforeach


                                            @if($item->validity>=Carbon::now())
                                            <input class="CouponValue" value="{{$item->coupon_code}}" type="text" placeholder="Coupon Code">

                                                @else
                                                <input class="CouponValue" value="upcomming" type="text" placeholder="Coupon Code">

                                            @endif

                                        <button type="button" class="Couponbutton">Apply Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>



                                        <li><span class="pull-left">Subtotal </span>${{$total}}</li>
                                        <li><span class="pull-left">Discount </span>{{$discount}}%</li>

                                        @if($discount)
                                        <li><span class="pull-left"> Total </span> ${{$total-($total/100)* $discount}}</li>
                                            @else
                                            <li><span class="pull-left">Subtotal </span>${{$total}}</li>
                                        @endif
                                    </ul>
                                    <a href="{{route('cheakout')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- cart-area end -->
    @endsection
@section('footer_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script>
     $(document).ready(function () {
        $('.remove').click(function () {
            var dataId = $(this).attr("data-id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                window.location.href = "{{url('/single/cart-delete')}}/"+ dataId;
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        })
         $('.Couponbutton').click(function () {
             var CouponValue = $('.CouponValue').val()
             window.location.href = "{{url('/cart')}}/"+ CouponValue;
         })

     })
    </script>
    @endsection