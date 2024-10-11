@extends('layout')

@section('title')
Danh sách nhân viên

@endsection


@section('content')


<div class="my-3 text-end">
    <a class="btn btn-primary" href="{{route('users.create')}}">Thêm mới</a>
</div>

@if(session('check') !== NULL)

        @if(session('check') === true)
            <div class="my-3 alert alert-success">
                Xóa thành công
            </div>
        @elseif(session('check') === false)
            <div class="my-3 alert alert-success">
                Xóa không thành công
            </div>
        @endif

    @endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listUser as $user)
        <tr>
            <td>{{$loop -> index + 1}}</td>
            <td>{{$user -> name}}</td>
            <td>{{$user -> email}}</td>
            <td>{{$user -> age}}</td>
            <td>{{$user -> tenphong}}</td>
            <td style="width: 1px;" class="text-nowrap">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal{{$loop->index+1}}">Chi tiết</button>
                <form action="{{route('users.destroy',['user'=>$user->id])}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có muốn xóa không ?')">Xóa</button>

                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@foreach($listUser as $user)
<div class="modal modal" id="myModal{{$loop->index+1}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết nhân viên</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex">
                    <div class="me-3">
                        <p><b>Họ tên: </b></p>
                        <p><b>Email: </b></p>
                        <p><b>Age: </b></p>
                        <p><b>Phòng ban: </b></p>
                    </div>
                    <div>
                        <p>{{$user -> name}}</p>
                        <p>{{$user -> email}}</p>
                        <p>{{$user -> age}}</p>
                        <p>{{$user -> tenphong}}</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="{{route('users.edit',['user'=> $user->id])}}" class="btn btn-primary">Chỉnh sửa</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endforeach

@endsection