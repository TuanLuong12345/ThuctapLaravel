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

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($news_banner as $key => $new_banner)
                            <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                                class="{{ $key === 0 ? 'active' : '' }}">
                            </li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @if($locale === 'vi')
                            @foreach($news_banner as $key => $new_banner)
                                <div class="item{{ $key === 0 ? ' active' : '' }}">
                                    <a  href="{{ route('home.news_one', ['locale' => $locale, 'id' => $new_banner->id]) }}">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('storage/images/' . $new_banner->thumbnail) }}" class="girl img-responsive" alt=""/>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            @foreach($news_banner_en as $key => $new_banner_en)
                                <div class="item{{ $key === 0 ? ' active' : '' }}">
                                    <a  href="{{ route('home.news_one', ['locale' => $locale, 'id' => $new_banner_en->id]) }}">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('storage/images/' . $new_banner_en->thumbnail) }}"
                                                class="girl img-responsive" alt=""/>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row ">
            <div class="col-sm-12 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Bài viết mới</h2>
                    @if($locale === 'vi')
                        @foreach($latest_news as $latest_new)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="storage/images/{{$latest_new->thumbnail}}" alt=""/>
                                            <h2>{{$latest_new->title}}</h2>
                                            <a class="all_information"
                                               href={{route('home.news_one',['locale'=>$locale,'id'=>$latest_new->id])}}">
                                                {{ trans('messages.detail') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($latest_news_en as $latest_new_en)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="storage/images/{{$latest_new_en->thumbnail}}" alt=""/>
                                            <h2>{{$latest_new_en->title}}</h2>
                                            <a class="all_information"
                                                href={{route('home.news_one',['locale'=>$locale,'id'=>$latest_new_en->id])}}">
                                                {{ trans('messages.detail') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                   @endif
                </div><!--features_items-->

            </div>
        </div>
    </div>
        <a href="{{route('home.news_all')}}">
        <h2 class="title text-center">{{ trans('messages.all_post') }}</h2>
        </a>
</section>

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
