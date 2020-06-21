@extends('asif.post.master')
@section('content')
    <div class="container">
        <h2 class="text-center"></h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-9 pb-5">
    <form action="{{url('/subcategory-post')}}" method="POST">
        @csrf
        <div class="card border-primary rounded-0">
            <div class="card-header p-0">
                <div class="bg-info text-white text-center py-2">
                    <h3><i class="fa fa-envelope"></i>View-SubCategory(total {{$scount}})</h3>
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
                        <th scope="col">subname</th>
                        <th scope="col">category_name</th>
                        <th scope="col">createad_at</th>
                        <th scope="col">updated_at</th>
                        <th scope="col">deleted_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subcategories as $key=>$subcategory)
                        <tr>
                            <th scope="row">{{$subcategories->firstItem()+ $key}}</th>
                            <td>{{$subcategory->subname}}</td>
                            {{--subcategory table->category table->name--}}
                            <td>{{$subcategory->get_category->name}}</td>
                            <td>{{$subcategory->created_at== ''? 'N/A':$subcategory->created_at->format("y-m-d").' '.'('.$subcategory->created_at->diffForHumans().')'}}</td>
                            <td>{{$subcategory->updated_at}}</td>
                            <td>
                                <a href="{{url('/subcategory-update')}}/{{$subcategory->id}}"class="btn btn-primary">Edit</a>
                                @if(App\subcategory::where('subname',$subcategory->subname)->exists())
                                    @else
                                    <a href="{{url('/subcategory-delete')}}/{{$subcategory->id}}"class="btn btn-danger">Delete</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    {{$subcategories->Links()}}

@endsection









