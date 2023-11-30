@extends('layout.admin')

@section('content')
<div  >
    <div class="profile_index col-md-12">
        <label class="form-label">
            Name:
        </label>
        <td>
            {{$My_User->name}}
        </td>
    </div>
    <div class="profile_index col-md-12">
        <label class="form-label">
            Email:
        </label>
        <td>
            {{$My_User->email}}
        </td>
    </div>
    <div class="profile_index col-md-12">
        <label class="form-label">
            Số điện thoại:
        </label>
        <td>
            {{$My_User->phone}}
        </td>
    </div>
    <div class="profile_index col-md-12">
        <label class="form-label">
            Vai trò:
        </label>
        <td>
            {{$My_User->role}}
        </td>
    </div>
    <a href="{{route('user.profile.edit',['id'=>$My_User->id])}}" class="btn btn-primary">Thay đổi thông tin</a>

    <a href="{{ route('user.profile.change_password',['id'=>$My_User->id])}}" class="btn btn-primary">Đổi Mật Khẩu</a>

</div>

@endsection
