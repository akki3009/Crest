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
        <div class="clearfix">
            <form action="{{ url('/prodSearch') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group col-md-4">
                    <a class="btn btn-primary" href="{{ route('addproduct') }}">Add New Product</a>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Price Range
                            <input type="text" name="start_price" id="start_price" placeholder="Minimum Price">
                            <input type="text" name="end_price" id="end_price" placeholder="Maximum Price">
                            <button type="submit" class="btn btn-primary">SearchPrice</button>
                        </label>
                        <label>Qunatity Range
                            <input type="text" name="qunatity_from" id="qunatity_from" placeholder="QuantityFrom">
                            <input type="text" name="qunatity_to" id="qunatity_to" placeholder="QuantityTo">
                            <button type="submit" class="btn btn-primary">SearchQuantity</button>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 row">
                    <input type="text" class="form-control col-md-6" placeholder="Product Search.." id="prod_search"
                        name="prod_search">&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary col-md-3">SearchProduct</button>
                </div>
            </form>
        </div>
        <br><br>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>ProductName</th>
                    <th>CategoryName</th>
                    <th>ProductImage</th>
                    <th>ProductCode</th>
                    <th>Price</th>
                    <th>SalePrice</th>
                    <th>Quantity</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>AddedDate</th>
                    <th>UpdateDate</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($product as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->pname }}</td>
                        <td>{{ $value->catid }}</td>
                        <td><img src="{{ url('asset/img/Productimage/' . $value->imagename) }}" width="90px"
                                height="90px">
                        </td>
                        <td>{{ $value->productcode }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->saleprice }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td>{{ $value->porder }}</td>
                        <td>{{ $value->pstatus }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{ $value->updated_at }}</td>
                        <td><a href="editPro/{{ $value->id }}" class="btn btn-success">Edit</a>
                            <a href="deletePro/{{ $value->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
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
