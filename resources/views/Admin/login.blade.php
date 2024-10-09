<!doctype html>
<html lang="en">

<head>
    <title>Đăng nhập trang quản trị</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('asset/img/Admin/icons/icon-48x48.png')}}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('asset/css/auth/style.css')}}">


</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">TRANG QUẢN TRỊ</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url({{asset('asset/img/auth/bg-1.jpg')}});">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Đăng nhập</h3>
                                </div>
                            </div>
                            @if(session('status') !== NULL)
                                @if(session('status') == false)
                                    <div class="alert alert-danger"><b>Vui lòng kiểm tra lại Email và Mật khẩu</b></div>
                                @endif
                            @endif
                            <form action="{{route('admin.login.post')}}" method="POST" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>@error('email')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror
                                    <input type="text" name="email" value="{{old('email',session('email'))}}" class="form-control" placeholder="Nhập Email....">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Mật khẩu</label>@error('password')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror
                                    <input type="password" name="password" class="form-control" placeholder="Nhập Mật khẩu....">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Ghi nhớ đăng nhập
                                            <input name="remember" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{asset('asset/js/auth/jquery.min.js')}}"></script>
    <script src="{{asset('asset/js/auth/popper.js')}}"></script>
    <script src="{{asset('asset/js/auth/bootstrap.min.js')}}"></script>
    <script src="{{asset('asset/js/auth/main.js')}}"></script>

</body>

</html>