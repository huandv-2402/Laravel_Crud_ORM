@extends('Admin/Layout/layout')

@section('title')
Chỉnh sửa sản phẩm
@endsection



@section('content')

<h1 class="h3 mb-3"><strong>CHỈNH SỬA SẢN PHẨM</strong></h1>

<div class="col-12 col-lg-12 col-xxl-12 d-flex">
    <div class="card flex-fill">
        <div class="card-header">

            <form action="{{route('admin.products.update',['product'=> $product -> id])}}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="mb-3 d-flex">
                    <div class="col-6 me-2">
                        <label for="" class="form-label"><b>Tên sản phẩm</b>@error('name')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                        <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label"><b>Danh mục</b>@error('category_id')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                        <select name="category_id" id="" class="form-select">
                            <option value="{{$temp->id}}">Chưa phân loại</option>
                            @foreach($categories as $category)
                            <option {{old('category_id',$product->CategoryId())==$category->id?"selected":""}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <div class="col-6 me-2">
                        <label for="" class="form-label"><b>Số lượng</b>@error('quantity')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                        <input type="number" name="quantity" class="form-control" value="{{old('quantity',$product->quantity)}}">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label"><b>Giá tiền</b>@error('price')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{old('price',$product->price)}}">
                    </div>
                </div>



                <div class="mb-3">
                    <label for="" class="form-label"><b>Ảnh danh mục</b>@error('image')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset('asset/img/Products/' . $product -> image)}}" style="width: 15%;" class="mt-2" alt="">
                </div>

                <div>
                    <label for="" class="form-label"><b>Mô tả</b>@error('description')<span style="color: red; font-size: 10px;">{{$message}}</span>@enderror</label>
                    <textarea name="description" id="" rows="5" class="form-control">{{old('description',$product->description)}}</textarea>
                </div>

                <div class="mt-5 text-center">
                    <a href="{{route('admin.products.index')}}" class="btn btn-danger">Quay lại</a>
                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </form>

        </div>
    </div>
</div>






@endsection