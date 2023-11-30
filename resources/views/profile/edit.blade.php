@extends('layout.admin')

@section('content')

    <form method="post" action="{{route('user.profile.update',['id'=>$usersProfile->id])}}">
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
                value="{{$usersProfile->name}}"
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
                value="{{$usersProfile->email}}"
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
                value="{{$usersProfile->phone}}"
                maxlength="10"
                pattern="0[0-9]{9}"
                title="Số điện thoại không đúng bao gồm 10 số và bắt đầu bằng số 0"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>


@endsection
