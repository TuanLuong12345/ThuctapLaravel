<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ trans('messages.login') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        rel="stylesheet"
        id="bootstrap-css"
    >
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/animate.css')}}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
<script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>
<script src="{{asset('Eshopper/js/respond.min.js')}}"></script>
<![endif]-->
    <link rel="shortcut icon" href="{{asset('Eshopper/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
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
                            <li><a href="{{route('home.index')}}" style="color: red;text-decoration: underline;margin-top: 40px" class="active" >{{ trans('messages.home') }}</a></li>
                            <li class="language-select" >
                                <a  href="{{ route('switch.language', ['locale' => 'vi']) }}">
                                    VI
                                </a>
                            </li>
                            <li ><a href="{{ route('switch.language', ['locale' => 'en']) }}">EN</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<div id="login">
    <h3 class="text-center text-white pt-5">{{ trans('messages.login_form') }}</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{route('login')}}" method="post">
                        @csrf
                        <h3 class="text-center text-info">{{ trans('messages.login_form') }}</h3>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input name="email"
                                   type="email"
                                   id="email"
                                   value="{{old('email')}}"
                                   class="form-control"
                                   required
                            >
                        </div>

                        @error('email')
                        <div class="alert alert-danger">* {{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="password" class="text-info">{{ trans('messages.password') }}:</label><br>
                            <input type="password"
                                   name="password"
                                   id="myInput"
                                   class="form-control"
                                   required
                            >
                        </div>
                        <input type="checkbox" onclick="myFunction()">{{ trans('messages.show_password') }}
                        @error('password')
                        <div class="alert alert-danger">* {{ $message }}</div>
                        @enderror
                        <div class="form-group" style="margin-left: -12px">
                            <a href="{{route('select_change_password.get')}}" class="btn btn-link">{{ trans('messages.forgot_password') }}</a>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="{{ trans('messages.login') }}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }


</script>
