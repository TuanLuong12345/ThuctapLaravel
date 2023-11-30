<!doctype html>
<html lang="en">
<head>
    <title>{{$infoOfType->title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/animate.css')}}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">
    <script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>
    <script src="{{asset('Eshopper/js/respond.min.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('Eshopper/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
          href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">


</head>
<body>
<section id="header" class="header_home"><!--header-->
    <div class="header-middle"><!--header-middle-->
        <div class="container ">
            <div class="row">
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav ">
                            <li><a href="{{route('login')}}"><i class="fa fa-user"></i>{{ trans('messages.login') }}</a></li>
                            <li><a href=""><i class="fa fa-lock"></i> {{ trans('messages.register') }}</a></li>
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
                            <li class="dropdown {{ Request::is('home/news*') ? 'active' : '' }}"><a
                                    href="{{route('home.news_all')}}">{{ trans('messages.news') }}</a>
                            </li>
                            <li class="dropdown {{ Request::is('home/contacts') ? 'active' : '' }}">
                                <a href="{{route('home.contacts')}}">{{ trans('messages.contacts') }}</a>
                            </li>
                            <li class="dropdown {{ Request::is('home/calender*') ? 'active' : '' }}">
                                <a href="{{route('home.calender')}}">{{ trans('messages.calender') }}</a>
                            </li>
                            @foreach($info_type as $infoType)
                                <li class="dropdown {{ Request::is("home/info/{$infoType->type}") ? 'active' : '' }}">
                                    <a href="{{ route('info.type', ['type' => $infoType->type]) }}">{{ $infoType->title }}</a>
                                </li>
                            @endforeach
                            <li class="language-select">
                                <a style="margin-right: -60px;margin-left: 10px"
                                   href="{{ route('switch.language', ['locale' => 'vi']) }}">
                                    VI
                                </a>
                            </li>
                            <li><a href="{{ route('switch.language', ['locale' => 'en']) }}">EN</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div><!--/header-bottom-->
</section><!--/header-->
<div class="home_menu" style="margin-top: 90px; margin-bottom: 10px;margin-left: 70px">
    <a  href="{{route('home.index')}}" > {{ trans('messages.home') }}</a>
    <span>  /  </span> <a href="#" >{{$infoOfType->title}}</a>
</div>
<div class="content-container" style="text-align: center;">
    <img src="{{ asset('storage/images/' . $infoOfType->thumbnail) }}"
         alt="Image"
         style="width: 85%; max-height: 200px; object-fit: cover; display: inline-block;"
    >

    <p style="margin-top: 20px">{!! $infoOfType->content !!}  </p>
</div>


<script src="{{asset('contacts/js/popper.js')}}"></script>
<script src="{{asset('contacts/js/bootstrap.min.js')}}"></script>
<script src="{{asset('contacts/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('contacts/js/main.js')}}"></script>


</body>
</html>


