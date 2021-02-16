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
        <form action="{{ isset(request()->id) ? route('updateform', $editcate->id) : route('addcategory') }}"
            method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="cname">CategoryName</label>
                <input type="text" class="form-control" name="cname" placeholder="CategoryName"
                    value="{{ isset(request()->id) ? $editcate->cname : '' }}">
                @error('cname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cimage">CategoryImage</label>
                <input type="file" class="form-control" name="cimage" placeholder=""
                    value="{{ isset(request()->id) ? $editcate->cimage : '' }}">
                @error('cimage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="row">
                    <div class="col-sm-4">
                        @if (request()->id)
                            <img src="{{ asset('asset/img/Categoryimage/' . $editcate->cimage) }}" width="70px"
                                height="70px">
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="corder">CategoryOrder</label>
                <input type="number" class="form-control" name="corder" placeholder="CategoryOrder"
                    value="{{ isset(request()->id) ? $editcate->corder : '' }}">
                @error('corder')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cstatus">Status</label>
                <select class="form-control" name="cstatus">
                    <option value="">--Select Status--</option>
                    <option value="Active"
                        {{ isset(request()->id) ? ($editcate->cstatus == 'Active' ? 'selected' : '') : '' }}>Active
                    </option>
                    <option value="Inactive"
                        {{ isset(request()->id) ? ($editcate->cstatus == 'Inactive' ? 'selected' : '') : '' }}>Inactive
                    </option>
                </select>
                @error('cstatus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if (request()->id)
                <input type="submit" name="update" class="btn btn-primary" value="Update Category">
            @else
                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
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
    </body>

    </html>
@endsection
