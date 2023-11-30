@extends('layout.admin')

@section('content')

    <form method="post" action="{{route('users.store')}}">
        @csrf
        <div class="col-md-6">
            <label  class="form-label">
                Name:
            </label>
            <input
                name="name"
                type="text"
                class="form-control"
                value="{{old('name')}}"
                placeholder="Nhập tên người dùng"
                maxlength="255"
                required
            >
            @error('name')
            <div class="alert alert-danger">* {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Email:
            </label>
            <input
                name="email"
                type="email"
                class="form-control"
                placeholder="Nhập email"
                maxlength="255"
                required
                value="{{old('email')}}"
            >
            @error('email')
            <div class="alert alert-danger">* {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Password:
            </label>
            <input
                name="password"
                type="password"
                class="form-control"
                maxlength="255"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                title="Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt"
                id="myInput"
                placeholder="Nhập mật khẩu"
                required
                value="{{old('password')}}"
            >
            <input type="checkbox" onclick="myFunction()">Show Password
            @error('password')
            <div class="alert alert-danger">* {{ $message }}</div>
            @enderror
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
                required
                value="{{old('confirmPassword')}}"
            >
            @error('confirmPassword')
            <div class="alert alert-danger">* {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6" >
            <label  class="form-label">
                Phone:
            </label>
            <input
                name="phone"
                type="text"
                class="form-control"
                placeholder="Nhập số điện thoại"
                maxlength="10"
                pattern="0[0-9]{9}"
                title="Số điện thoại không đúng bao gồm 10 số và bắt đầu bằng số 0"
                required
                value="{{old('phone')}}"
            >
            @error('phone')
            <div class="alert alert-danger">* {{ $message }}</div>
            @enderror
        </div>
{{--        <div class="col-md-6">--}}
{{--            <label  class="form-label">--}}
{{--                Role:--}}
{{--            </label>--}}
{{--            <input--}}
{{--                name="role"--}}
{{--                type="text"--}}
{{--                class="form-control"--}}
{{--                placeholder="Nhập vai trò"--}}
{{--                required--}}
{{--                value="{{old('role')}}"--}}
{{--            >--}}
{{--            @error('role')--}}
{{--            <div class="alert alert-danger">* {{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}
        <div class="col-md-6 " style="display: grid">Chọn vai trò:
            <label>
                <input type="radio"
                       name="role"
                       class="role_user"
                       value="admin">
                Admin
            </label>
            <label>
                <input type="radio"
                       name="role"
                       class="role_user"
                       value="user"
                > User
            </label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Thêm người dùng
        </button>
    </form>

@endsection


