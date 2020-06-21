@extends('asif.post.master')


@section('content')
    <div class="container">
        <h2 class="text-center"></h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-10 pb-5">


                <!--Form with header-->

                <form action="{{url('/product-post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><i class="fa fa-envelope"></i> Add-Product</h3>
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
                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_name</h6></span></div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" value="{{old('product_name')}}" class="form-control" id="product_name" name="product_name" placeholder="Input product_name" required>
                                </div>
                            </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>Category</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach($categories as $cat)

                                                <option value ="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>Add-Subcategory</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <select name="subcategory_id" id="category_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach($subcategories as $scat)

                                                <option value ="{{$scat->id}}">{{$scat->subname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_summary</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <textarea input type="text" value="{{old('product_summary')}}" class="form-control" id="product_summary" name="product_summary" placeholder="Input product_summary" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_description</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                       <textarea input type="text" value="{{old('product_description')}}" class="form-control" id="product_description" name="product_description" placeholder="Input product_description" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_price</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" value="{{old('product_price')}}" class="form-control" id="product_price" name="product_price" placeholder="Input product_price" required>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_quantity</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" value="{{old('product_quantity')}}" class="form-control" id="product_quantity" name="product_quantity" placeholder="Ex-10;" required>
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>product_thumbnail</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="file" value="{{old('product_thumbnail')}}" class="form-control" id="product_thumbnail" name="product_thumbnail" placeholder="Product Preview" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>preview_thumbnail</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            {{--<div class="input-group-text"></div>--}}
                                        </div>
                                        <img id="blah" alt="your image" width="150" height="150" />
                                    </div>
                                </div>

                                <div class="form-group"><div style="text-align: center"><span style="color: green"><h6>Image Gallary</h6></span></div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="file"multiple name="product_galary[]" value="{{old('product_galary')}}" class="form-control" id="product_galary"  placeholder="Product Preview" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
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