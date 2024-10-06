<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar overflow-auto vh-100">

		<!-- LOGO -->
		<a class="sidebar-brand" href="">
			<span class="align-middle">TRANG QUẢN TRỊ</span>
		</a>

		<!-- ĐIỀU HƯỚNG -->
		<ul class="sidebar-nav">

			<!-- USER -->
			<!-- <li class="sidebar-header">Người dùng</li>
					<li class="sidebar-item mb-2">
						<a class="sidebar-link" data-bs-toggle="collapse" href="#user" role="button"
							aria-expanded="false" aria-controls="collapseExample">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Quản lý tài
								khoản</span>
						</a>
						<div class="collapse" id="user">
							<ul class="list-unstyled ps-3">
								<li><a class="sidebar-link" href="">Danh sách khách hàng</a></li>
								<li><a class="sidebar-link" href="">Danh sách nhân viên</a></li>
							</ul>
						</div>
					</li> -->

			<!-- Category -->
			<li class="sidebar-header">Danh mục</li>
			<li class="sidebar-item mb-2">
				<a class="sidebar-link" href="{{route('admin.categories.index')}}">
					<i class="align-middle" data-feather="sidebar"></i> <span class="align-middle">Danh sách
						danh mục</span>
				</a>
			</li>

			<!-- POST -->
			<li class="sidebar-header">Sản phẩm</li>
			<li class="sidebar-item mb-2">
				<a class="sidebar-link" href="{{route('admin.products.index')}}">
					<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Danh sách
						sản phẩm</span>
				</a>
			</li>

			<!-- Comment -->
			<!-- <li class="sidebar-header">Bình luận</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="">
							<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Danh sách
								bình luận</span>
						</a>
					</li> -->
		</ul>


	</div>
</nav>