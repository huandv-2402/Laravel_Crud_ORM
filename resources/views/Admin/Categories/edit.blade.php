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
                    <label for="" class="form-label"><b>Tên danh mục</b>@error('name')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label"><b>Ảnh danh mục</b>@error('image')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
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



@endsection
