@extends('Admin/Layout/layout')

@section('title')
Danh sách sản phẩm
@endsection



@section('content')

<h1 class="h3 mb-3"><strong>DANH SÁCH SẢN PHẨM</strong></h1>

<div class="text-end mb-3">
    <a href="{{route('admin.products.create')}}" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
</div>


@if(session('delete') !== NULL)
@if(session('delete') == true)
<div class="alert alert-success"><b>Xóa sản phẩm thành công</b></div>
@elseif(session('delete')==false)
<div class="alert alert-danger"><b>Xóa sản phẩm không thành công</b></div>
@endif
@endif

@if(session('add') !== NULL)
@if(session('add') == true)
<div class="alert alert-success"><b>Thêm sản phẩm thành công</b></div>
@elseif(session('add')==false)
<div class="alert alert-danger"><b>Thêm sản phẩm không thành công</b></div>
@endif
@endif

@if(session('update') !== NULL)
@if(session('update') == true)
<div class="alert alert-success"><b>Cập nhật sản phẩm thành công</b></div>
@elseif(session('update')==false)
<div class="alert alert-danger"><b>Cập nhật sản phẩm không thành công</b></div>
@endif
@endif

<div class="col-12 col-lg-12 col-xxl-12 d-flex">




    <div class="card flex-fill">
        <div class="card-header">

            <!-- TOP 10 NHÀ BÁO MỚI VÀ TRẠNG THÁI -->
            <div class="card-title mb-0 row">
                <div class="col-md-12 col-12 col-xxl-12 mb-12">
                    <form action="{{route('admin.products.index')}}" method="GET" class="row">
                        <label for="" class="form-label"><b>Tìm kiếm</b></label>
                        <div class="col-xxl-2 col-md-2 col-12 mb-2">
                            <select name="category_id" id="" class="form-select">
                                @if(count($categories) == 0)
                                    <option value="0">Không có danh mục nào</option>
                                @else
                                    <option value="0">Tất cả</option>
                                    <option @if($category_id == "-1") selected @endif value="-1">Chưa phân loại</option>
                                    @foreach($categories as $category)             
                                        <option @if($category->id == $category_id) selected @endif value="{{$category -> id}}" >{{$category -> name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xxl-10 col-md-10 col-12 d-flex">
                            <input type="text" class="form-control me-2" name="search" value="{{$search??''}}" placeholder="Tìm kiếm...">
                            <button class="btn btn-primary">Tìm</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        @if(count($products) == 0)

        <h1 class="text-center w-100 mb-4">Không tìm thấy sản phẩm nào</h1>

        @else
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">STT</th>
                    <th>Sản phẩm</th>
                    <th class="d-none d-md-table-cell">Ảnh</th>
                    <th class="d-none d-xl-table-cell">Danh mục</th>
                    <th class="d-none d-xl-table-cell">Số lượng</th>
                    <th class="d-none d-xl-table-cell">Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                @foreach($products as $product)
                <tr>
                    <td class="d-none d-xl-table-cell">{{$loop->index + 1}}</td>
                    <td><b>{{$product -> name}}</b></td>
                    <td class="d-none d-md-table-cell"><img src="{{asset('asset/img/Products/' . $product -> image)}}" style="width: 20%" class="img-fluid" alt=""></td>
                    <td class="d-none d-xl-table-cell"><b>{{$product->nameCategory()}}</b></td>
                    <td class="d-none d-xl-table-cell">{{$product->quantity}}</td>
                    <td class="d-none d-xl-table-cell">{{$product->price}}</td>
                    <td style="width: 1px;" class="text-nowrap">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$loop->index}}">
                            Chi tiết
                        </button>

                        <form action="{{route('admin.products.destroy',['product'=> $product -> id])}}" method="POST" class="d-inline">
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
           {{$products->links()}}
        </div>
        @endif
    </div>




</div>




@foreach($products as $product)
<!-- MODAL -->
<div class="modal modal-xl" id="modal-{{$loop->index}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">THÔNG TIN SẢN PHẨM</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xxl-3 col-md-12 col-12 mb-2">
                        <img src="{{asset('asset/img/Products/' . $product->image)}}" class="img-fluid" width="100%" alt="">
                    </div>

                    <div class="col-xxl-9 col-md-12 col-12 d-flex">
                        <div class="col-3">
                            <p><b>Tên: </b></p>
                            <p><b>Danh mục: </b></p>
                            <p><b>Số lượng: </b></p>
                            <p><b>Giá: </b></p>
                            <p><b>Thời gian tạo: </b></p>
                            <p><b>Thời gian cập nhật: </b></p>
                            <p><b>Mô tả: </b></p>
                        </div>
                        <div>
                            <p>{{$product->name}}</p>
                            <p>{{$product->nameCategory()}}</p>
                            <p>{{$product->quantity}}</p>
                            <p>{{$product->price}}</p>
                            <p>{{$product->created_at}}</p>
                            <p>{{$product->updated_at}}</p>
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="{{route('admin.products.edit',['product' => $product->id])}}" class="btn btn-dark">Sửa</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
@endforeach



@endsection