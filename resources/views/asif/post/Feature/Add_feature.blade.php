@extends('asif.post.master')


@section('content')
    <div class="container">
        <h2 class="text-center"></h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8 pb-5">


                <!--Form with header-->

                <form action="{{route('feature_post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><i class="fa fa-envelope"></i>Featire Form</h3>
                                <p class="m-0"></p>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('success')}}
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
                        <!--Body-->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Feature Name" required>
                                </div>
                            </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="file" class="form-control" id="name" name="image" placeholder="Feature Name" required>
                                    </div>
                                </div>

                            <div class="text-center">
                                <input type="submit" value="submit" class="btn btn-info btn-block rounded-0 py-2">
                            </div>
                        </div>

                    </div>
                </form>
                <!--Form with header-->


            </div>
        </div>
    </div>
@endsection