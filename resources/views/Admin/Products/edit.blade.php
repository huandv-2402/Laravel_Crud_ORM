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
                        <label for="" class="form-label"><b>Tên sản phẩm</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['name']['error']}}</span>@endif</label>
                        <input type="text" name="name" class="form-control" value="@if(session('name')!==NULL){{session('name')}}@else{{$product->name}}@endif">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label"><b>Danh mục</b></label>
                        <select name="category_id" id="" class="form-select">
                            <option value="{{$temp->id}}">Chưa phân loại</option>
                            @foreach($categories as $category)
                            <option @if(session('category_id') !=NULL && session('category_id')==$category->id)
                                selected
                                @elseif($product->id == $category->id)
                                selected
                                @endif value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <div class="col-6 me-2">
                        <label for="" class="form-label"><b>Số lượng</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['quantity']['error']}}</span>@endif</label>
                        <input type="number" name="quantity" class="form-control" value="@if(session('quantity')!==NULL){{session('quantity')}}@else{{$product->quantity}}@endif">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label"><b>Giá tiền</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['price']['error']}}</span>@endif</label>
                        <input type="number" name="price" class="form-control" value="@if(session('price')!==NULL){{session('price')}}@else{{$product->price}}@endif">
                    </div>
                </div>



                <div class="mb-3">
                    <label for="" class="form-label"><b>Ảnh danh mục</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['image']['error']}}</span>@endif</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset('asset/img/Products/' . $product -> image)}}" style="width: 15%;" class="mt-2" alt="">
                </div>

                <div>
                    <label for="" class="form-label"><b>Mô tả</b>@if(session('error')!==NULL)<span style="color: red; font-size: 10px;">{{session('error')['description']['error']}}</span>@endif</label>
                    <textarea name="description" id="" rows="5" class="form-control">@if(session('description')!==NULL){{session('description')}}@else{{$product->description}}@endif</textarea>
                </div>

                <div class="mt-5 text-center">
                    <a href="{{route('admin.products.index')}}" class="btn btn-danger">Quay lại</a>
                    <button class="btn btn-success">Thêm mới</button>
                </div>
            </form>

        </div>
    </div>
</div>






@endsection