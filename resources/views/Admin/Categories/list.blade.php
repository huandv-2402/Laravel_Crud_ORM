@extends('Admin/Layout/layout')

@section('title')
Danh sách danh mục
@endsection


@section('content')

<h1 class="h3 mb-3"><strong>DANH SÁCH DANH MỤC</strong></h1>

<div class="text-end mb-3"> 
    <a href="{{route('admin.categories.create')}}" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
</div>


@if(session('delete') !== NULL)
    @if(session('delete') == true)
<div class="alert alert-success"><b>Xóa danh mục thành công</b></div>
    @elseif(session('delete')==false)
<div class="alert alert-danger"><b>Xóa danh mục không thành công</b></div>
    @endif
@endif

@if(session('add') !== NULL)
    @if(session('add') == true)
<div class="alert alert-success"><b>Thêm danh mục thành công</b></div>
    @elseif(session('add')==false)
<div class="alert alert-danger"><b>Thêm danh mục không thành công</b></div>
    @endif
@endif

@if(session('update') !== NULL)
    @if(session('update') == true)
<div class="alert alert-success"><b>Cập nhật danh mục thành công</b></div>
    @elseif(session('update')==false)
<div class="alert alert-danger"><b>Cập nhật danh mục không thành công</b></div>
    @endif
@endif

<div class="col-12 col-lg-12 col-xxl-12 d-flex">



    
    <div class="card flex-fill">
        <div class="card-header">

            <!-- TOP 10 NHÀ BÁO MỚI VÀ TRẠNG THÁI -->
            <div class="card-title mb-0 row">
                <div class="col-md-12 col-12 col-xxl-5 mb-3">
                    <form action="{{route('admin.categories.index')}}" method="GET">
                        <label for="" class="form-label"><b>Tìm kiếm</b></label>
                        <input type="text" class="form-control" name="search" value="{{$search??''}}" placeholder="Tìm kiếm...">
                    </form>
                </div>

            </div>
        </div>

        @if(count($categories) == 0)

    <h1 class="text-center w-100 mb-4">Không tìm thấy danh mục nào</h1>

    @else
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">STT</th>
                    <th>Tên danh mục</th>
                    <th class="d-none d-md-table-cell">Ảnh</th>
                    <th>Số sản phẩm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                @foreach($categories as $category)
                <tr>
                    <td class="d-none d-xl-table-cell">{{$loop->index + 1}}</td>
                    <td>{{$category -> name}}</td>
                    <td class="d-none d-md-table-cell"><img src="{{asset('asset/img/Categories/' . $category -> image)}}" style="width: 20%" class="img-fluid" alt=""></td>
                    <td>{{$category -> countProducts()}}</td>
                    <td style="width: 1px;" class="text-nowrap">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$loop->index}}">
                            Chi tiết
                        </button>

                        <form action="{{route('admin.categories.destroy',['category'=> $category -> id])}}" method="POST" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger" onclick=" return confirm('Bạn có muốn xóa không ?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer">
            {{$categories->links()}}    
        </div>
        
        @endif
    </div>




</div>




@foreach($categories as $category)
<!-- MODAL -->
<div class="modal" id="modal-{{$loop->index}}">
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
                        <img src="{{asset('asset/img/Categories/' . $category->image)}}" class="img-fluid" width="100%" alt="">
                    </div>

                    <div class="col-xxl-9 col-md-12 col-12 d-flex">
                        <div class="me-3">
                            <p><b>Danh mục: </b></p>
                            <p><b>Sản phẩm: </b></p>
                            <p><b>Thời gian tạo: </b></p>
                            <p><b>Thời gian cập nhật: </b></p>
                        </div>
                        <div>
                            <p>{{$category->name}}</p>
                            <p>{{$category -> countProducts()}}</p>
                            <p>{{$category->created_at}}</p>
                            <p>{{$category->updated_at}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="{{route('admin.categories.edit',['category' => $category->id])}}" class="btn btn-dark">Sửa</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
    @endforeach



    @endsection