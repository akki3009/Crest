@extends('dashboard')
@section('content')
    @include('successerror')
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
            <select class="form-control js-example-basic-single" name="cname">
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

    <link href="{{ asset('asset/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('asset/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".alert").fadeTo(2000).slideUp(2000, function() {
                $(".alert").slideUp(2000);
            });
            $('.js-example-basic-single').select2();
        });

    </script>
@endsection
