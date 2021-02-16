@extends('dashboard')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>

    <body>
        @if (Session::get('error'))
            <div class="alert alert-danger">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        <form action="{{ isset(request()->id) ? route('updateform', $editprod->id) : route('addproduct') }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="pname">Product Name</label>
                <input type="text" class="form-control" name="pname" placeholder="Enter Product Name"
                    value="{{ isset(request()->id) ? $editprod->pname : old('pname') }}">
                @error('pname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if (isset(request()->id))
                @php
                    $catid = explode(',', $editprod->cname);
                @endphp
            @endif
            <div class="form-group">
                <label>Category Name</label>
                <select class="form-control" name="cname">
                    @if (isset(request()->id))
                        <option name="cname" value="{{ $editprod->id }}">{{ $editprod->categoryname->cname }}</option>
                        @foreach ($category as $val)
                            <option value="{{ $val['id'] }}" @if (in_array($val['id'], $catid)) selected @endif> {{ $val['cname'] }} </option>
                        @endforeach
                    @else
                        @foreach ($category as $val)
                            <option class="form-control" name="cname" value="{{ $val['id'] }}">{{ $val['cname'] }}
                            </option>
                        @endforeach
                    @endif

                </select>
                @error('cname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" name="price" placeholder="Enter Product Price"
                    value="{{ isset(request()->id) ? $editprod->price : old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="saleprice">Product Sale Price</label>
                <input type="number" class="form-control" name="saleprice" placeholder="Enter Product Sale Price"
                    value="{{ isset(request()->id) ? $editprod->saleprice : old('saleprice') }}">
                @error('saleprice')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Product Quantity</label>
                <input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity"
                    value="{{ isset(request()->id) ? $editprod->quantity : old('quantity') }}">
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="porder">Product Order</label>
                <input type="number" class="form-control" name="porder" placeholder="Enter Product Order"
                    value="{{ isset(request()->id) ? $editprod->porder : old('porder') }}">
                @error('porder')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pstatus">Status</label>
                <select class="form-control" name="pstatus">
                    <option value="">--Select Status--</option>
                    <option value="Active"
                        {{ isset(request()->id) ? ($editprod->pstatus == 'Active' ? 'selected' : '') : '' }}>Active
                    </option>
                    <option value="Inactive"
                        {{ isset(request()->id) ? ($editprod->pstatus == 'Inactive' ? 'selected' : '') : '' }}>Inactive
                    </option>
                </select>
                @error('pstatus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="imagename">Product Image</label>
                <input type="file" class="form-control" name="imagename[]" placeholder=""
                    value="{{ isset(request()->id) ? $editprod->imagename : '' }}" multiple>
                @error('imagename')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    @if (isset(request()->id))
                        @foreach ($editprod->imagenames as $image)
                            @if ($image->istatus == 'Active')
                                <img class="active-image m-2  border border-success"
                                    src="{{ asset('asset/img/Productimage/' . $image->imagename) }}" alt="product-Image"
                                    height="75px" width="75px">
                            @else
                                <img src="{{ asset('asset/img/Productimage/' . $image->imagename) }}" alt="product-Image"
                                    height="75px" width="75px">
                                <a href="{{ route('activeimage', ['id' => $editprod->id, 'imgid' => $image->imgid]) }}"
                                    class="btn btn-outline-success">Active</a>
                                <a href={{ route('deleteimage', ['imgid' => $image->imgid]) }}
                                    class="btn btn-outline-danger">Delete</a><br>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
            @if (request()->id)
                <input type="submit" name="update" class="btn btn-primary" value="Update Product">
            @else
                <input type="submit" name="submit" class="btn btn-primary" value="Add Product">
            @endif
        </form>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('dist/js/demo.js') }}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".alert").fadeTo(2000).slideUp(2000, function() {
                    $(".alert").slideUp(2000);
                });
            });

        </script>
    </body>

    </html>
@endsection
