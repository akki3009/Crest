@extends('dashboard')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection
@section('content')
    @include('successerror')
    <div>
        <div class="form-row">
            <div class="from-group col-md-6">
                <a class="btn btn-primary" href="{{ route('category') }}">Add New Category</a>
            </div>
            <div class="from-group col-md-6">
                <input type="text" class="form-control col-md-6 float-right" placeholder="Category Search.." id="cat_search"
                    name="cat_search">
            </div>
        </div>
    </div>
    <table id="myTable" class="table">
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

            {{-- {{$category}} --}}
            @foreach ($category as $value)
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



@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
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
                            // console.log(data);
                            $('tbody').html(data);
                        }
                    });
                }
            });
            $(".alert").fadeTo(2000).slideUp(2000, function() {
                $(".alert").slideUp(2000);
            });
            $('#myTable').DataTable();
        });

    </script>
@endpush
