@extends('asif.frontend.master')

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Register</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="account-form form-style">
                        <p>User Name *</p>
                        <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    <p>User Email Address *</p>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    <p>Password *</p>
                    <input type="Password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" name="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror


                    <p>Confirm Password *</p>
                    <input type="Password" required autocomplete="new-password" name="password_confirmation">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    <button type="submit">Register</button>
                    <div class="text-center">
                        <a href="{{url('/login')}}">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
