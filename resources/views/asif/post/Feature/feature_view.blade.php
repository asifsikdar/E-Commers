@extends('asif.post.master')
@section('content')
    <div class="container">
        <h2 class="text-center"></h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-9 pb-5">
                <form action="{{url('/category-post')}}" method="POST">
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><i class="fa fa-envelope"></i>View-Feature</h3>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">createad_at</th>

                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($view as $key=>$cat)
                                    <tr>
                                        <th scope="row">{{$view->firstItem()+ $key}}</th>
                                        <td>{{$cat->name}}</td>
                                        <td><img src="{{url('public/feature_image/'.$cat->image)}}" width="100px" alt=""></td>
                                        <td>{{$cat->created_at== ''? 'N/A':$cat->created_at->format('y-m-d').' '.'('.$cat->created_at->diffForHumans().')'}}</td>
                                        {{--<td>{{$cat->updated_at->format('y-m-d')}}</td>--}}
                                        <td>
                                            <a href="{{url('/view-update')}}/{{$cat->id}}"class="btn btn-primary">Edit</a>
                                            <a href="{{url('/view-delete')}}/{{$cat->id}}"class="btn btn-danger">Delete</a>
                                        </td>
                                @endforeach
                                </tbody>
                            </table>
    {{$view->Links()}}

@endsection








