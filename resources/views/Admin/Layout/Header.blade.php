<nav class="navbar navbar-expand navbar-light navbar-bg">
	<!-- ẨN HIỆN MENU ĐỨNG -->
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<!-- ĐIỀU HƯỚNG -->
	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">

			@auth
			<!-- TÀI KHOẢN -->
			<li class="nav-item dropdown">

				<!-- ICON TÀI KHOẢN -->
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
					data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>

				<!-- ẢNH TÀI KHOẢN -->
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
					data-bs-toggle="dropdown">
					<img src="{{asset('asset/img/Admin/avatars/avatar.jpg')}}" class="avatar img-fluid rounded me-1"
						alt="Charles Hall" /> <span class="text-dark">{{Auth::user()->name}}</span>
				</a>

				<!-- ĐIỀU HƯỚNG TÀI KHOẢN -->
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{route('index')}}"><i class="align-middle me-1"
							data-feather="type"></i> Trang chủ</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
							data-feather="user"></i> Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{route('admin.logout')}}">Log out</a>
				</div>
			</li>
			@endauth
		</ul>
	</div>
</nav>