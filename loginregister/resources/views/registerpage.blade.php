<!DOCTYPE html>
<html>

<head>
    <title>My Awesome Login Page</title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{ asset('asset/img/logo.png') }}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="{{ route('register_data') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control input_name" value=""
                                placeholder="name">
                            </div>
                            @error('name')
                                <div class="text-default">{{ $message }}</div>
                            @enderror

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control input_email" value=""
                                placeholder="email">
                            </div>
                            @error('email')
                                <div class="text-default">{{ $message }}</div>
                            @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value=""
                                placeholder="password">
                            </div>
                            @error('password')
                                <div class="text-default">{{ $message }}</div>
                            @enderror
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <input type="submit" name="button" value="Register" class="btn login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
