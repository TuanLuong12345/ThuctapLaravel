<!DOCTYPE html>
<html>

<head>
    <title>{{ trans('messages.forgot_password') }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head>

<body>
<header id="header"><!--header-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('login')}}" style="color: red;text-decoration: underline;margin-top: 40px" class="active" >{{ trans('messages.login') }}</a></li>
                            <li class="language-select" >
                                <a style="margin-top: 40px; margin-left: 320px; margin-right: -30px" href="{{ route('switch.language', ['locale' => 'vi']) }}">
                                    VI
                                </a>
                            </li>
                            <li ><a style="margin-top: 40px" href="{{ route('switch.language', ['locale' => 'en']) }}">EN</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<!--/header-->

<div class="container" >
    <h3 style="text-align: center;color: red">{{ trans('messages.forgot_password') }}?</h3>
    <h5 style="text-align: center;color:rebeccapurple">{{ trans('messages.select_forgot_password') }}</h5>

    <div class="options" style="display: flex; flex-direction: column; gap: 20px;margin-top: 100px;margin-left: 350px">
        <div style="margin-bottom: 50px;">
            <a href="{{route('forget.password.get')}}"
               style="text-decoration: none; color: #fff; padding: 10px 20px; border-radius: 5px; background-color: dodgerblue"
            >
                {{ trans('messages.select_forgot_password_1') }}
            </a>
        </div>
        <div>
            <a href="{{route('forget-password-token.get')}}"
               style="text-decoration: none; color: #fff; padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; "
            >
                {{ trans('messages.select_forgot_password_2') }}
            </a>
        </div>
    </div>
</div>
</body>

</html>
