<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ trans('messages.home') }}</title>
    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>
    <script src="{{asset('Eshopper/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('Eshopper/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="#"><img src="{{asset('Eshopper/images/home/logo.png')}}" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Language
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="language-select">
                                    <a href="{{ route('switch.language', ['locale' => 'vi']) }}">
                                        VI
                                    </a>
                                </li>
                                <li><a href="{{ route('switch.language', ['locale' => 'en']) }}">EN</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('users.register')}}"><i class="fa fa-user"></i>{{ trans('messages.register') }}</a></li>
                            <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> {{ trans('messages.login') }}
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li class="dropdown {{ Request::is('home') ? 'active' : '' }}">
                                <a href="{{ route('home.index') }}">{{ trans('messages.home') }}</a>
                            </li>
                            <li class="dropdown {{ Request::is('home/news*') ? 'active' : '' }}">
                                <a href="{{route('home.news_all')}}">{{ trans('messages.news') }}</a>
                            </li>
                            <li class="dropdown {{ Request::is('home/contacts') ? 'active' : '' }}">
                                <a href="{{route('home.contacts')}}">{{ trans('messages.contacts') }}</a>
                            </li>
                            <li class="dropdown {{ Request::is('home/calender*') ? 'active' : '' }}">
                                <a href="{{route('home.calender')}}">{{ trans('messages.calender') }}</a>
                            </li>
                            @foreach($info_type as $infoType)
                                <li class="dropdown {{ Request::is("home/info/{$infoType->id}") ? 'active' : '' }}">
                                    <a href="{{ route('info.type', ['type' => $infoType->type]) }}">{{ $infoType->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<form method="post" action="{{route('users.register.store')}}">
    @csrf
    <div class="col-md-12">
        <label class="form-label ">
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
    <div class="col-md-12">
        <label class="form-label">
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
    <div class="col-md-12">
        <label class="form-label">
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
        @error('password')
        <div class="alert alert-danger">* {{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">
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
    <div class="col-md-12">
        <label class="form-label">
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
    <button
        type="submit"
        class="btn btn-primary "
        style="margin-left: 10%;margin-top: 2%; margin-bottom: 6%"
    >
        Đăng kí
    </button>
</form>

<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank"
                                                           href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->


<script src="{{asset('Eshopper/js/jquery.js')}}"></script>
<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('Eshopper/js/price-range.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('Eshopper/js/main.js')}}"></script>
</body>
</html>
