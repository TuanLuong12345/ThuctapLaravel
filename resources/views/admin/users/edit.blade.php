@extends('layout.admin')

@section('content')

    <form method="post" action="{{route('users.update',['id'=>$users->id])}}">
        @csrf
        <div class="col-md-6">
            <label  class="form-label">
                Name:
            </label>
            <input
                name="name"
                type="text"
                maxlength="255"
                class="form-control"
                value="{{$users->name}}"
                required
            >


        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Email:
            </label>
            <input
                name="email"
                type="email"
                maxlength="255"
                class="form-control"
                value="{{$users->email}}"
                required
            >

        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Password:
            </label>
            <input
                name="password"
                type="password"
                class="form-control"
                value="{{$users->password}}"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                maxlength="255"
                title="Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt"
                required
            >
        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Confirm Password:
            </label>
            <input
                name="confirmPassword"
                type="password"
                class="form-control"
                placeholder="Nhập lại mật khẩu"
                maxlength="255"
                value="{{$users->password}}"
                required
            >
        </div>
        <div class="col-md-6" >
            <label  class="form-label">
                Phone:
            </label>
            <input
                name="phone"
                type="text"
                class="form-control"
                value="{{$users->phone}}"
                maxlength="10"
                pattern="0[0-9]{9}"
                title="Số điện thoại không đúng bao gồm 10 số và bắt đầu bằng số 0"
                required
            >

        </div>
        <div class="col-md-6" style="display: grid">
            Chọn vai trò:
            <label>
                <input type="radio" name="role" class="role_user" value="admin" {{ $users->role === 'admin' ? 'checked' : '' }}>
                Admin
            </label>
            <label>
                <input type="radio" name="role" class="role_user" value="user" {{ $users->role === 'user' ? 'checked' : '' }}>
                User
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

@endsection
