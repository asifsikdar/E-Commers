@extends('asif.frontend.master')
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wishlist</h2>
                        <ul>
                            <li><a href="{{'/'}}">Home</a></li>
                            <li><span>Wishlist</span></li>
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
                    @if(session('WishlistDelete'))
                        <div class="alert alert-danger" role="alert">
                            {{session('WishlistDelete')}}
                        </div>
                    @endif
                    <form action="http://themepresss.com/tf/html/tohoney/cart">
                        <table class="table-responsive cart-wrap">
                            <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="stock">Stock Stutus </th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wishes as $wish)
                                <input type="hidden" value="{{$wish->id}}" name="id[]">
                            <tr>
                                <td class="images"><img src="{{url('/public/img/thumbnail')}}/{{$wish->product->product_thumbnail}}" alt=""></td>
                                <td class="product"><a href="{{route('SingleProduct',$wish->product->id)}}">{{$wish->product->product_name}}</a></td>
                                <td class="ptice">${{$wish->product->product_price}}</td>
                                <td class="stock">In Stock</td>
                                <td class="addcart"><a href="{{route('Cart')}}">Add to Cart</a></td>
                                <td class="remove" href="{{url('/single-wishlist-delete')}}/{{$wish->id}}"><i class="fa fa-times"></i></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    @endsection