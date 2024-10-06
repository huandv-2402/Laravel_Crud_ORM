@extends('Admin/Layout/layout')

@section('title')
    Thêm mới danh mục
@endsection



@section('content')

<h1 class="h3 mb-3"><strong>THÊM MỚI DANH MỤC</strong></h1>

<div class="col-12 col-lg-12 col-xxl-12 d-flex">
    <div class="card flex-fill">
        <div class="card-header">

            <form action="{{route('admin.categories.store')}}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label"><b>Tên danh mục</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['name']['error']}}</span>@endif</label>
                    <input type="text" name="name" class="form-control" value="@if(session('name')!==NULL){{session('name')}}@endif">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label"><b>Ảnh danh mục</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['image']['error']}}</span>@endif</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mt-5 text-center">
                    <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Quay lại</a>
                    <button class="btn btn-success">Thêm mới</button>
                </div>
            </form>

        </div>
    </div>
</div>




@endsection
