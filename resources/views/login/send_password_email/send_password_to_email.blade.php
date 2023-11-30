<html>
<head>
    <title>Laravel</title>
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
        .language_en {
            margin-top: 40px;
            margin-left: 400px;
            margin-right: -75px;
            font-size: 25px;
            color: black;
        }

        .language_vi {
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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" style="width: 100%; text-align: left;">
                <a class="nav-link"
                   style="width: 170px;margin-left: -38px"
                   href="{{route('select_change_password.get')}}"
                >
                    {{ trans('messages.change your password') }}
                </a>
            </li>

        </ul>
        <ul class="nav navbar-nav collapse navbar-collapse" style="margin-left: 550px;">
            <li class="language-select">
                <a class="language_en" href="{{ route('switch.language', ['locale' => 'en']) }}">
                    EN
                </a>
            </li>
            <li>
                <a class="language_vi" href="{{ route('switch.language', ['locale' => 'vi']) }}">
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
                    <h3 class="card-header " style="color: green;text-align: center"> {{ trans('messages.send_password_email') }} </h3>
                    <div class="card-body">

                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <form action="{{ route('forget-password-token.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right"> {{ trans('messages.email_address') }}</label>
                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        id="email_address"
                                        class="form-control"
                                        name="email"
                                        required
                                        maxlength="255"
                                        autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('messages.send_password_email') }}
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









