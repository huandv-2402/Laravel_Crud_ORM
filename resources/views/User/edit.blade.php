@extends('layout')

@section('title')
Chỉnh sửa thông tin
@endsection

@section('content')

@if(session('check') !== NULL)

    @if(session('check'))
        <div class="my-3 alert alert-success">
            Chỉnh sửa thành công
        </div>
    @else
        <div class="my-3 alert alert-success">
            Chỉnh sửa không thành công
        </div>
    @endif

@endif

<h2 class="my-3">Chỉnh sửa thông tin</h2>

<form action="{{route('users.update',['user'=> $user->id])}}" method="POST" class="border px-5 py-3">

    @method('PATCH')
    @csrf

    <div class="mb-3">
        <label for="" class="form-label"><b>Name</b><span style="color: red; font-size: 10px;">@if(session('error')!== NULL) {{session('error')["name"]??""}} @endif</span></label>
        <input type="text" class="form-control" name="name" value="@if(session('data')!==NULL){{session('data')['name']}}@else{{$user->name}}@endif">
    </div>

    <div class="mb-3">
        <label for="" class="form-label"><b>Email</b><span style="color: red; font-size: 10px;"></span></label>
        <input type="email" class="form-control" name="email" value="{{$user -> email}}" disabled>
    </div>

    <div class="mb-3">
        <label for="" class="form-label"><b>Age</b><span style="color: red; font-size: 10px;">@if(session('error')!== NULL) {{session('error')["age"]??""}} @endif</span></label>
        <input type="number" min="18" class="form-control" name="age" value="@if(session('data')!==NULL){{session('data')['age']}}@else{{$user->age}}@endif">
    </div>

    <div class="mb-5">
        <label for="" class="form-label"><b>Department</b></label>
        <select name="department_id" id="" class="form-select">
            @foreach($listDepartment as $department)
            <option @if(session('data')!==NULL) @if(session('data')['department_id'] == $department->id) selected  @endif @elseif($department->id == $user->department_id) selected @endif value="{{$department -> id}}">{{$department->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">Lưu</button>
        <a href="{{route('users.index')}}" class="btn btn-danger">Quay lại</a>
    </div>
</form>


@php
unset($_SESSION["error"]);
unset($_SESSION["status"]);
@endphp

@endsection