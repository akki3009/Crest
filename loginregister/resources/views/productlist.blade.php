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
        {{-- <h1>Sucessfully Added</h1> --}}
        <div>
            <div class="form-row">
                <div class="from-group col-md-6">
                    <a class="btn btn-primary" href="{{ route('addproduct') }}">Add New Product</a>
                </div>
                <div class="from-group col-md-6">
                    <input type="text" class="form-control col-md-6 float-right" placeholder="Product Search.."
                        id="prod_search" name="prod_search">
                </div>
            </div>
        </div>
        <div></div>
        <div></div>
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
                        <td><img src="{{ url('asset/img/Productimage/' . $value->imagename) }}" width="90px" height="90px">
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
                            <a href="deletePro/{{ $value->id }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
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
