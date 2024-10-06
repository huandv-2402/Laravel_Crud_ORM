<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	


	<title>@yield('title')</title>


    <link rel="shortcut icon" href="{{asset('asset/img/Admin/icons/icon-48x48.png')}}" />
	<link href="{{asset('asset/css/Admin/Template.css')}}" rel="stylesheet">
	<link href="{{asset('asset/css/Admin/Bs5.css')}}" rel="stylesheet">
	
	
</head>

<body>
	<div class="wrapper">



		<!-- CHIẾM 30%  -->
		@include('Admin/Layout/SideBar')


		<!-- CHIẾM 70% -->
		<div class="main">

			<!-- MENU NGANG -->
			@include('Admin/Layout/Header')

			<!-- NỘI DUNG HIỂN THỊ -->
			<main class="content">
				<div class="container-fluid p-0">
					
                    @yield('content')

				</div>
				
			</main>


			<!-- FOOTER -->
			@include('Admin/Layout/Footer')
		</div>
	</div>





	<script src="{{asset('asset/js/Admin/Template.js')}}"></script>

    @stack('script')
	
</body>

</html>

