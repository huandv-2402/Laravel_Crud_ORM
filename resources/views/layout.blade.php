<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <title>@yield('title')</title>
</head>

<body>

    <div class="container">

        <nav class="navbar navbar-expand-sm bg-success navbar-dark mb-3">

            <div class="container-fluid">
                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">Quản lý nhân viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chức năng 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chức năng 3</a>
                    </li>
                </ul>
            </div>

        </nav>

        <div>
            @yield('content')
        </div>
    </div>

</body>

</html>