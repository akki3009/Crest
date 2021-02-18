@extends('dashboard')
@section('content')
    <form action="{{ isset(request()->id) ? route('updateCategory', $editcate->id) : route('addcategory') }}"
        method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="cname">CategoryName</label>
            <input type="text" class="form-control" name="cname" placeholder="CategoryName"
                value="{{ isset(request()->id) ? $editcate->cname : old('cname') }}">
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
                        <img src="{{ asset('asset/img/Categoryimage/' . $editcate->cimage) }}" width="70px" height="70px">
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="corder">CategoryOrder</label>
            <input type="number" class="form-control" name="corder" placeholder="CategoryOrder"
                value="{{ isset(request()->id) ? $editcate->corder : old('corder') }}">
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
            <input type="submit" name="submit" class="btn btn-primary" value="Update Category">
        @else
            <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
        @endif
    </form>
@endsection
