@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Category Form</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
  <h1>Hello Friends</h1>
  
  {{-- <div class="container">
    <div class="root">

      <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{isset(request()->cid) ? route('updateform',$edit->cid) : route('addcategory')  }}" data-parsley-validate="" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="card-body">
          @if(Session::has('error'))
					<p class="alert alert-danger">{{ Session::get('error') }}</p>
			  	@endif
            <div class="form-group">
              <label for="InputName">Category Name</label>
              <input type="text" class="form-control" name="cname" id="InputName" placeholder="Enter Category Name" value="{{ isset(request()->cid) ? $edit->cname :''}}" required>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                  <label for="Inputorder">Order</label>
                  <input type="number" class="form-control" name="corder" id="Inputorder" placeholder="Enter order" value="{{ isset(request()->cid) ? $edit->corder :''}}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="cstatus">
                    <option value="">--Select Status--</option>
                    <option value="active" {{isset(request()->cid) ? ($edit->cstatus=='active') ? "selected" :'':''}}>Active</option>
                    <option value="inactive" {{isset(request()->cid) ? ($edit->cstatus=='inactive') ? "selected" :'':''}}>Inactive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="InputFile">Upload Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="InputFile" name="cimage" value="{{ isset(request()->cid) ? $edit->cimage :''}}">
                  <label class="custom-file-label" for="InputFile">Choose file</label>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                @if(request()->cid)
                <img src="{{asset('Categoryimage/'.$edit->cimage)}}" width="100px" height="100px">
                @endif
              </div>
            </div>
          </div>
          <div class="card-footer">
            @if(request()->cid)
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            @else
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            @endif
          </div>
        </form>

      </div>
    </div>

  </div>
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script> --}}
</body>

</html>
@endsection