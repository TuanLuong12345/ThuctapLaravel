
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
                        <a class="nav-link" href="{{route('login')}}">{{ trans('messages.login') }}</a>
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
<h1 style="text-align: center;color: red;margin-top: 200px;" >{{ trans('messages.expired_password_reset_link') }}</h1>

