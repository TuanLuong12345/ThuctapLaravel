<html>
<head>
    <title> {{ trans('messages.forgot_password') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .nav-link {
            display: inline-block; /* Hiển thị là block để có thể thiết lập chiều rộng và chiều cao */
            width: 100px; /* Độ rộng của ô */
            padding: 10px; /* Kích thước padding */
            text-decoration: none; /* Loại bỏ gạch chân mặc định */
            color: black; /* Màu chữ màu đen */
            background-color: dodgerblue; /* Màu nền xanh da trời */
            border: 2px solid dodgerblue; /* Viền */
            border-radius: 5px; /* Bo tròn góc */
            transition: all 0.3s ease; /* Hiệu ứng chuyển đổi khi hover */
            text-align: center; /* Canh giữa nội dung */
            font-weight: bold; /* Chữ in đậm */
        }

        .nav-link:hover {
            background-color: white; /* Màu nền khi di chuột vào */
            color: dodgerblue; /* Màu chữ khi di chuột vào */
        }
        .language_en{
            margin-top: 40px;
            margin-left: 400px;
            margin-right: -75px;
            font-size: 25px;
            color: black;
        }
        .language_vi{
            margin-top: 40px;
            font-size: 25px;
            color: black;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}"> {{ trans('messages.login') }}</a>
                    </li>
            </ul>
            <ul class="nav navbar-nav collapse navbar-collapse" style="margin-left: 600px;">
                <li class="language-select" >
                    <a class="language_en"  href="{{ route('switch.language', ['locale' => 'en']) }}">
                        EN
                    </a>
                </li>
                <li >
                    <a class="language_vi"  href="{{ route('switch.language', ['locale' => 'vi']) }}">
                        VI
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('messages.reset_password') }}</div>
                    <div class="card-body">

                        <form action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">{{ trans('messages.email_address') }}</label>
                                <div class="col-md-6">
                                    <input type="text"
                                           id="email_address"
                                           class="form-control"
                                           name="email"
                                           maxlength="255"
                                           value="{{$email}}"
                                           required
                                           autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('messages.password') }}</label>
                                <div class="col-md-6">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        required
                                        maxlength="255"
                                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                        title="Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt"
                                        autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('messages.confirm_password') }}</label>
                                <div class="col-md-6">
                                    <input type="password"
                                           id="password-confirm"
                                           class="form-control"
                                           name="password_confirmation"
                                           maxlength="255"
                                           required autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('messages.reset_password') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
