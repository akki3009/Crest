@extends('dashboard')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        @if (Session::get('error'))
            <div class="alert alert-danger">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        {{-- product
category
imagename --}}
        {{-- {{$category->id}} --}}
        {{-- @foreach ($category as $key => $item)
            {{$item}}
        @endforeach --}}
        {{-- {{$editprod}} --}}
        {{-- {{ isset(request()->id)}} --}}
        <form action="{{ isset(request()->id) ? route('updateform', $editprod->id) : route('addproduct') }}" method="post"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="pname">Product Name</label>
                <input type="text" class="form-control" name="pname" placeholder="Enter Product Name"
                    value="{{ isset(request()->id) ? $editprod->pname : '' }}">
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
                    value="{{ isset(request()->id) ? $editprod->price : '' }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="saleprice">Product Sale Price</label>
                <input type="number" class="form-control" name="saleprice" placeholder="Enter Product Sale Price"
                    value="{{ isset(request()->id) ? $editprod->saleprice : '' }}">
                @error('saleprice')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Product Quantity</label>
                <input type="number" class="form-control" name="quantity" placeholder="Enter Product Quantity"
                    value="{{ isset(request()->id) ? $editprod->quantity : '' }}">
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="porder">Product Order</label>
                <input type="number" class="form-control" name="porder" placeholder="Enter Product Order"
                    value="{{ isset(request()->id) ? $editprod->porder : '' }}">
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
            <div class="row">
                <div class="col-sm-4">
                @if(isset(request()->id))
                    @php
                        foreach($images as $key => $value)
                          {
                              if($value['istatus'] == 'Active')
                               {
                                   $activeimage[] = $value['imagename'];
                                }
                            elseif($value['istatus'] == 'Inactive')
                            {
                                $inactiveimage[] = $value['imagename'];
                                $newid[] = $value['imgid'];
                            }
                         }
                    @endphp
                    {{-- {{count(activeimage)}} --}}
                        @for($i = 0;$i < count($activeimage);$i++)
                                <img src="{{asset('asset/img/Productimage/'.$activeimage[$i])}}" width="150px" height="150px"><br><br>
                        @endfor
                        @for($i = 0;$i < count($inactiveimage);$i++)
                                <img src="{{asset('asset/img/Productimage/'.$inactiveimage[$i])}}" width="100px" height="100px">
                                <a href="{{route('activeimage',['id'=>$editprod->id ,'imgid'=>$newid[$i]])}}" class="btn btn-outline-success">Active</a>
                                <a href="{{route('deleteimage',['imgid'=>$newid[$i]])}}" class="btn btn-outline-danger">Delete</a><br>
                        @endfor
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
