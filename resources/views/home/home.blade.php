<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ trans('messages.home') }} </title>
    <link href="Eshopper/css/bootstrap.min.css" rel="stylesheet">
    <link href="Eshopper/css/font-awesome.min.css" rel="stylesheet">
    <link href="Eshopper/css/prettyPhoto.css" rel="stylesheet">
    <link href="Eshopper/css/price-range.css" rel="stylesheet">
    <link href="Eshopper/css/animate.css" rel="stylesheet">
    <link href="Eshopper/css/main.css" rel="stylesheet">
    <link href="Eshopper/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="Eshopper/js/html5shiv.js"></script>
    <script src="Eshopper/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="Eshopper/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="Eshopper/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="Eshopper/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="Eshopper/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="Eshopper/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<header id="header" class="header_home"><!--header-->
    <div class="header-middle"><!--header-middle-->
        <div class="container ">
            <div class="row">
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav ">
                            <li><a href="{{route('login')}}"><i class="fa fa-user"></i>{{ trans('messages.login') }}</a>
                            </li>
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
                                <li class="dropdown {{ Request::is("home/info/{$infoType->id}") ? 'active' : '' }}">
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
</header><!--/header-->

<section id="slider"><!--slider-->

    <div class="container">
        <div class="row">

            <div style="height: 750px" class="col-sm-12 float-right">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                        @foreach($news_banner as $key => $new_banner)
                            <li data-target="#slider-carousel" data-slide-to="0"
                                class="{{$key == 0 ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner ">
                        @if($locale === 'vi')
                            @foreach($news_banner as $key => $new_banner)
                                <div class="item {{$key == 0 ? 'active' : ''}} ">
                                    <div class="col-sm-12">
                                        <a href="{{route('home.news_one',['locale'=>$locale,'id'=>$new_banner->id])}}">
                                            <img src="storage/images/{{$new_banner->thumbnail}}"
                                                 style="height: 750px;width: 100%;object-fit: cover;  overflow: hidden;"
                                                 class="girl img-responsive" alt=""/>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($news_banner_en as $key => $new_banner_en)
                                <div class="item {{$key == 0 ? 'active' : ''}} ">
                                    <div class="col-sm-12">
                                        <a href="{{route('home.news_one',['locale'=>$locale,'id'=>$new_banner_en->id])}}">
                                            <img src="storage/images/{{$new_banner_en->thumbnail}}"
                                                 style="height: 750px;width: 100%;object-fit: cover;  overflow: hidden;"
                                                 class="girl img-responsive" alt=""/>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-10  padding-right" style="margin-left: 100px;">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"> {{ trans('messages.new_post') }}</h2>
                    <div class="col-sm-12 float-left ">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                @if($locale === 'vi')
                                    @foreach($latest_news as $key => $latest_new)
                                        <a href="{{route('home.news_one',['locale'=>$locale,'id'=>$latest_new->id])}}">
                                            <div class="productinfo text-center col-md-4  ">
                                                <h2>{{ $latest_new->title }}</h2>
                                                <img
                                                    style="height: 200px;object-fit: cover"
                                                    src="storage/images/{{$latest_new->thumbnail}}" alt=""/>
                                                {{--                                        <p>{!! $latest_new->content !!}</p>--}}
                                                {{--                                    <a href="#" class="btn btn-default ">Xem chi tiết</a>--}}
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    @foreach($latest_news_en as $key => $latest_new_en)
                                        <a href="{{route('home.news_one',['locale'=>$locale,'id'=>$latest_new_en->id])}}">
                                            <div class="productinfo text-center col-md-4  ">
                                                <h2>{{ $latest_new_en->title }}</h2>
                                                <img
                                                    style="height: 200px;object-fit: cover"
                                                    src="storage/images/{{$latest_new_en->thumbnail}}" alt=""/>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--features_items-->
        </div>
    </div>
    <a href="{{route('home.news_all')}}">
        <h2 class="title text-center">{{ trans('messages.all_post') }}</h2>
    </a>

</section>


<script src="{{asset('Eshopper/js/jquery.js')}}"></script>
<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('Eshopper/js/price-range.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('Eshopper/js/main.js')}}"></script>


</body>
</html>

