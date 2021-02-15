@extends('dashboard')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Category Listing</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>

    <body class="hold-transition sidebar-mini">

        @if (Session::has('success'))
            <div class="alert alert-success">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>

            </div>

            <!-- /.card-header -->
            <div class="row">
                <div class="col-sm-3">
                    <div class="container">
                        <a class="btn btn-primary" href="{{ route('Categoryform') }}">Add New Category</a>
                    </div>
                </div>
                <div class="col-sm-3">

                </div>
                <div class="col-sm-3">

                </div>

                <div class="col-sm-3">
                    <label for="">Search :</label>
                    <input type="text" placeholder="Search.." id="btnsearch" name="search">
                    <button type="submit" name="buttonsearch" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <input type="hidden" />
                            <th hidden>id</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Product Count</th>
                            <th>Added Date</th>
                            <th>Modified Date</th>
                            <th>Category Order</th>
                            <th>Category Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat as $key => $item)
                            <tr>
                                <input type="hidden" class="getidforjs" value="{{ $item->cid }}">
                                <td hidden>{{ $item->cid }}</td>
                                <td>{{ $item->cname }}</td>
                                <td><img src="{{ url('Categoryimage/' . $item->cimage) }}" width="100px"
                                        height="100px"></td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->corder }}</td>
                                <td>{{ $item->cstatus }}</td>

                                <td>
                                    <a href="edit/{{ $item->cid }}" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger servideletebtn"">Delete</button>
                            </td>
                        </tr>
                         @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- DataTables -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->

        <script src="{{ asset('dist/js/demo.js') }}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(e) {

                $('.servideletebtn').click(function() {
                    e.preventDefault();
                    var del_id = $(this).closest('tr').find('.getidforjs').val();
                    // alert(del_id);
                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this imaginary file!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    type: "GET",
                                    url: 'deleterecords/' + del_id,
                                    data: {
                                        "id": del_id,
                                    },
                                    success: function(response) {
                                        swal(response.status, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                // {{ route('c_index') }}
                                                location.reload();
                                                // window.location.href = url;
                                            });
                                    }
                                });
                            } else {
                                swal("Your Category is Safe!");
                            }
                        });
                });
            });

        </script>



    </body>

    </html>
@endsection
