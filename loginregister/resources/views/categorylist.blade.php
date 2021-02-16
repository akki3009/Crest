@extends('dashboard')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Category Listing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>

    <body>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        <div>
            <div class="form-row">
                <div class="from-group col-md-6">
                    <a class="btn btn-primary" href="{{ route('addcategory') }}">Add New Category</a>
                </div>
                <div class="from-group col-md-6">
                    <input type="text" class="form-control col-md-6 float-right" placeholder="Category Search.."
                        id="cat_search" name="cat_search">
                </div>
            </div>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>CategoryName</th>
                    <th>CategoryImage</th>
                    <th>CategoryOrder</th>
                    <th>CategoryStatus</th>
                    <th>Added Date</th>
                    <th>Update Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->cname }}</td>
                        <td><img src="{{ url('asset/img/Categoryimage/' . $value->cimage) }}" width="80px" height="70px">
                        </td>
                        <td>{{ $value->corder }}</td>
                        <td>{{ $value->cstatus }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{ $value->updated_at }}</td>
                        <td><a href="edit/{{ $value->id }}" class="btn btn-success">Edit</a></td>
                        <td><a href="delete/{{ $value->id }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('dist/js/demo.js') }}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                document.addEventListener("keydown", function(e) {
                    if (e.keyCode === 13) {
                        $search_val = $('#cat_search').val();
                        $.ajax({
                            type: 'get',
                            url: '{{ URL::to('search_val') }}',
                            data: {
                                'search_val': $search_val
                            },
                            success: function(data) {
                                console.log(data);
                                $('tbody').html(data);
                            }
                        });
                    }
                })
                $(".alert").fadeTo(2000).slideUp(2000, function() {
                    $(".alert").slideUp(2000);
                });
            });

        </script>

    </body>

    </html>
@endsection
