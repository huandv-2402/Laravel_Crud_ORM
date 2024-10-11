@extends('layout')

@section('title')
    Thêm mới nhân viên
@endsection

@section('content')

    @if(session('check') !== NULL)

        @if(session('check') === true)
            <div class="my-3 alert alert-success">
                Thêm mới thành công
            </div>
        @elseif(session('check') === false)
            <div class="my-3 alert alert-success">
                Thêm mới không thành công
            </div>
        @endif

    @endif
    

    <h2 class="my-3">Thêm mới nhân viên</h2>

    <form action="{{route('users.store')}}" method="POST" class="border px-5 py-3">

        @csrf

        <div class="mb-3">
            <label for="" class="form-label"><b>Name</b><span style="color: red; font-size: 10px;">@if(session('error')!== NULL) {{session('error')["name"]??""}} @endif</span></label>
            <input type="text" class="form-control" name="name" value="@if(session('data')!==NULL){{session('data')['name']??''}}@endif">
        </div>

        <div class="mb-3">
            <label for="" class="form-label"><b>Email</b><span style="color: red; font-size: 10px;">@if(session('error')!== NULL) {{session('error')["email"]??""}} @endif</span></label>
            <input type="email" class="form-control" name="email" value="@if(session('data')!==NULL){{session('data')['email']??''}}@endif">
        </div>

        <div class="mb-3">
            <label for="" class="form-label"><b>Age</b><span style="color: red; font-size: 10px;">@if(session('error')!== NULL) {{session('error')["age"]??""}} @endif</span></label>
            <input type="number" min="18" class="form-control" name="age" value="@if(session('data')!==NULL){{session('data')['age']??''}}@endif">
        </div>

        <div class="mb-5">
            <label for="" class="form-label"><b>Department</b></label>
            <select name="department_id" id="" class="form-select">
                @foreach($listDepartment as $department)
                    <option value="{{$department -> id}}" @if(session('data')!==NULL) @if(session('data')['department_id'] == $department->id) selected @endif @endif>{{$department->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Thêm</button>
            <a href="{{route('users.index')}}" class="btn btn-danger">Quay lại</a>
        </div>
    </form>

    
    @php
        unset($_SESSION["error"]);
        unset($_SESSION["status"]);
    @endphp

@endsection

