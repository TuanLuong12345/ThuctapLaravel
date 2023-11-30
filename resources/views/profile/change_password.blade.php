@extends('layout.admin')

@section('content')

    <form method="post" action="{{route('user.profile.update_password',['id'=>$User_changPassword->id])}}">
        @csrf

        <div class="col-md-6">
            <label  class="form-label">
                Mật khẩu mới:
            </label>
            <input
                name="password"
                type="password"
                class="form-control"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                maxlength="255"
                title="Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt"
                required
            >
        </div>
        <div class="col-md-6">
            <label  class="form-label">
                Nhập lại mật khẩu mới:
            </label>
            <input
                name="confirmPassword"
                type="password"
                class="form-control"
                placeholder="Nhập lại mật khẩu"
                maxlength="255"
                required
            >
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
    </form>

@endsection
