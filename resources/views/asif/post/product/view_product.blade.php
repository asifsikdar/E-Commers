@extends('asif.post.dashboard')
@section('content')



    <div class="container">
        <h2 class="text-center"></h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-12 pb-5">
                <form action="{{url('/')}}" method="POST">
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><i class="fa fa-envelope"></i>View-Product</h3>
                                <p class="m-0"></p>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            @if(session('delete'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('delete')}}
                                </div>
                                <hr>
                            @endif

                                @if(session('update'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('update')}}
                                    </div>
                                    <hr>
                                @endif



                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">product_name</th>
                                    <th scope="col">category</th>
                                    <th scope="col">sub_category</th>
                                    <th scope="col">product_price</th>
                                    <th scope="col">product_quantity</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key=>$item)
                                    <tr>
                                        <td scope="row">{{$products->firstItem()+$key}}</td>
                                        <td>{{$item->product_name}}</td>

                                        <td>{{$item->get_category->name }}</td>
                                        {{--<td>{{$item->get_subcategory->subname }}</td>--}}
                                        <td>${{$item->product_price}}</td>
                                        <td>{{$item->product_quantity}}</td>
                                        <td><img src="{{url('/public/img/thumbnail/').'/'.$item->product_thumbnail}}" width="150px"></td>

                                        <td>



                                            @if(App\billings::where('product_id',$item->id)->exists())

                                                @else
                                                <a href="{{url('/product-delete')}}/{{$item->id}}"class="btn btn-danger">Delete</a>
                                                @endif

                                            <a target="_blank" href="{{url('/item')}}/{{$item->slug}}"class="btn btn-primary">View</a>
                                            <a href="{{url('/product-edit')}}/{{$item->id}}"class="btn btn-primary">Edit</a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

    {{$products->Links()}}


@endsection









