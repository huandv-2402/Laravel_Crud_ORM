@extends('Admin/Layout/layout')

@section('title')
    Chỉnh sửa danh mục
@endsection



@section('content')

<h1 class="h3 mb-3"><strong>CHỈNH SỬA DANH MỤC</strong></h1>

<div class="col-12 col-lg-12 col-xxl-12 d-flex">
    <div class="card flex-fill">
        <div class="card-header">

            <form action="{{route('admin.categories.update',['category'=> $category->id])}}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="" class="form-label"><b>Tên danh mục</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['name']['error']}}</span>@endif</label>
                    <input type="text" name="name" class="form-control" value="@if(session('name')!==NULL){{session('name')}}@else{{$category->name}}@endif">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label"><b>Ảnh danh mục</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['image']['error']}}</span>@endif</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset('asset/img/Categories/' . $category -> image)}}" style="width: 30%;" class="mt-2" alt="">
                </div>

                <div class="mt-5 text-center">
                    <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Quay lại</a>
                    <button class="btn btn-success">Lưu</button>
                </div>
            </form>

        </div>
    </div>
</div>





    <!-- MODAL -->
    <div class="modal" id="modal-1">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
             <div class="modal-header">
                <h4 class="modal-title">THÔNG TIN DANH MỤC</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xxl-3 col-md-12 col-12 mb-2">
                        <img src="{{asset('asset/img/Admin/avatars/avatar-2.jpg')}}" class="img-fluid" width="100%" alt="">
                    </div>

                    <div class="col-xxl-9 col-md-12 col-12 d-flex">
                        <div class="me-3">
                            <p><b>Danh mục: </b></p>
                            <p><b>Thời gian tạo: </b></p>
                            <p><b>Thời gian cập nhật: </b></p>
                        </div>
                        <div>
                            <p>Dương Huấn</p>
                            <p>Huandvph43667@gmail.com</p>
                            <p>23/07/2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="" class="btn btn-dark">Sửa</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>

         </div>`
    </div>



@endsection
