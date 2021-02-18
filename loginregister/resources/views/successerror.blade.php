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
