<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ trans('messages.news') }}</title>
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="#"><img src="{{asset('Eshopper/images/home/logo.png')}}" alt="" /></a>
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
                            <li><a href=""><i class="fa fa-user"></i>{{ trans('messages.register') }}</a></li>
                            <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> {{ trans('messages.login') }}</a></li>
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
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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

<div class="container">
        <div class="row">
            <div class="col-sm-12  padding-right" >
                <div class="home_menu">
                    <a href="{{route('home.index')}}" > {{ trans('messages.home') }}</a> <span>  /  </span> <a href="{{route('home.news_all')}}" > {{ trans('messages.news') }}</a>
                </div>
                <div class="features_items"><!--features_items-->

                    <h2 class="title text-center"> {{ trans('messages.all_post') }}</h2>
                    <div class="col-sm-12 float-left ">
                        <div class="product-image-wrapper">
                            <div class="product-list">
                                @if($locale ==='vi')
                                @foreach($news as $key => $new)
                                    <div class="productinfo text-center col-md-4">
                                    Xử lý dưới js
                                    </div>
                                @endforeach
                                @else
                                    @foreach($news_En as $key => $new_En)
                                        <div class="productinfo text-center col-md-4">
                                                                            Xử lý dưới js
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div><!--features_items-->
        </div>
    </div>
    <div class="pagination"></div>

<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->

<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;">
    <i class="fa fa-angle-up">
    </i>
</a>

<script src="{{asset('Eshopper/js/jquery.js')}}"></script>
<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('Eshopper/js/price-range.js')}}"></script>
<script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('Eshopper/js/main.js')}}"></script>
<script>
    const locale = "{{ $locale }}";
    // Giả sử bạn có một mảng chứa tất cả bài viết
    const allNews = <?php echo json_encode($locale === 'vi' ? $news : $news_En); ?>;
    // Đảm bảo rằng $news_all chứa một mảng dữ liệu bài viết

    const itemsPerPage = 3; // Số bài viết trên mỗi trang
    let currentPage = 1; // Trang hiện tại

    function displayNews(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedNews = allNews.slice(startIndex, endIndex);

        // Hiển thị bài viết của trang hiện tại
        const productDiv = document.querySelector('.product-list');

        productDiv.innerHTML = '';
        paginatedNews.forEach(news => {
            const title = news.title

            const newsItem = `
                <div class="productinfo text-center col-md-4" data-id="${news.id}">
                    <h2>${title}</h2>
                    <img style="object-fit: cover" src="{{ asset('storage/images/') }}/${news.thumbnail}" alt=""/>
                    <a class="all_information" href="#" onclick="showDetails(${news.id})">{{ trans('messages.detail') }}</a>
                </div>
            `;

            productDiv.innerHTML += newsItem;
        });

        // Hiển thị phân trang
        const totalPages = Math.ceil(allNews.length / itemsPerPage);
        const paginationDiv = document.querySelector('.pagination');
        paginationDiv.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                paginationDiv.innerHTML += `<a href="#" onclick="changePage(${i})" class="current">${i}</a>`;
            } else {
                paginationDiv.innerHTML += `<a href="#" onclick="changePage(${i})">${i}</a>`;
            }
        }
    }
    function showDetails(newsId) {
        // Chuyển hướng đến trang chi tiết bài viết với ID đã truyền vào
        const detailUrl = "{{ route('home.news_one', ['locale' => ':locale', 'id' => ':id']) }}"
            .replace(':locale', locale)
            .replace(':id', newsId);
        window.location.href = detailUrl;
    }
    function changePage(page) {
        currentPage = page;
        displayNews(currentPage);
    }

    // Hiển thị bài viết ban đầu khi trang được tải
    displayNews(currentPage);
</script>
</body>
</html>
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta name="description" content="">--}}
{{--    <meta name="author" content="">--}}
{{--    <title>{{ trans('messages.news') }} </title>--}}
{{--    <link href="{{asset('Eshopper/css/bootstrap.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/font-awesome.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/prettyPhoto.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/price-range.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/animate.css')}}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/main.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('Eshopper/css/responsive.css')}}" rel="stylesheet">--}}
{{--    <!--[if lt IE 9]>--}}
{{--<script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/respond.min.js')}}"></script>--}}
{{--<![endif]-->--}}
{{--    <link rel="shortcut icon" href="{{asset('Eshopper/images/ico/favicon.ico')}}">--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="144x144"--}}
{{--          href="{{asset('Eshopper/images/ico/apple-touch-icon-144-precomposed.png')}}">--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="114x114"--}}
{{--          href="{{asset('Eshopper/images/ico/apple-touch-icon-114-precomposed.png')}}">--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="72x72"--}}
{{--          href="{{asset('Eshopper/images/ico/apple-touch-icon-72-precomposed.png')}}">--}}
{{--    <link rel="apple-touch-icon-precomposed"--}}
{{--          href="{{asset('Eshopper/images/ico/apple-touch-icon-57-precomposed.png')}}">--}}
{{--</head><!--/head-->--}}

{{--<body>--}}
{{--<header id="header" class="header_home"><!--header-->--}}
{{--    <div class="header-middle"><!--header-middle-->--}}
{{--        <div class="container ">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-8">--}}
{{--                    <div class="shop-menu pull-right">--}}
{{--                        <ul class="nav navbar-nav ">--}}
{{--                            <li><a href="{{route('login')}}"><i class="fa fa-user"></i>{{ trans('messages.login') }}</a></li>--}}
{{--                            <li><a href=""><i class="fa fa-lock"></i> {{ trans('messages.register') }}</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div><!--/header-middle-->--}}

{{--    <div class="header-bottom"><!--header-bottom-->--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-9">--}}
{{--                    <div class="navbar-header">--}}
{{--                        <button type="button" class="navbar-toggle" data-toggle="collapse"--}}
{{--                                data-target=".navbar-collapse">--}}
{{--                            <span class="sr-only">Toggle navigation</span>--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="mainmenu pull-left">--}}
{{--                        <ul class="nav navbar-nav collapse navbar-collapse">--}}
{{--                            <li class="dropdown {{ Request::is('home') ? 'active' : '' }}">--}}
{{--                                <a href="{{ route('home.index') }}">{{ trans('messages.home') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="dropdown {{ Request::is('home/news*') ? 'active' : '' }}"><a href="{{route('home.news_all')}}">{{ trans('messages.news') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="dropdown {{ Request::is('home/contacts') ? 'active' : '' }}">--}}
{{--                                <a href="{{route('home.contacts')}}">{{ trans('messages.contacts') }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="dropdown {{ Request::is('home/calender*') ? 'active' : '' }}">--}}
{{--                                <a href="{{route('home.calender')}}">{{ trans('messages.calender') }}</a>--}}
{{--                            </li>--}}
{{--                            @foreach($info_type as $infoType)--}}
{{--                                <li class="dropdown {{ Request::is("home/info/{$infoType->id}") ? 'active' : '' }}">--}}
{{--                                    <a href="{{ route('info.type', ['type' => $infoType->type]) }}">{{ $infoType->title }}</a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                            <li class="language-select" >--}}
{{--                                <a style="margin-right: -60px;margin-left: 10px" href="{{ route('switch.language', ['locale' => 'vi']) }}">--}}
{{--                                    VI--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li ><a href="{{ route('switch.language', ['locale' => 'en']) }}">EN</a></li>--}}
{{--                        </ul>--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div><!--/header-bottom-->--}}
{{--</header><!--/header-->--}}


{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-10  padding-right" >--}}
{{--            <div class="home_menu">--}}
{{--                <a href="{{route('home.index')}}" > {{ trans('messages.home') }}</a> <span>  /  </span> <a href="{{route('home.news_all')}}" > {{ trans('messages.news') }}</a>--}}
{{--            </div>--}}
{{--            <div class="features_items"><!--features_items-->--}}

{{--                <h2 class="title text-center"> {{ trans('messages.all_post') }}</h2>--}}
{{--                <div class="col-sm-12 float-left ">--}}
{{--                    <div class="product-image-wrapper">--}}
{{--                        <div class="product-list">--}}
{{--                            @if($locale ==='vi')--}}
{{--                            @foreach($news as $key => $new)--}}
{{--                                <div class="productinfo text-center col-md-4">--}}
{{--                                Xử lý dưới js--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                            @else--}}
{{--                                @foreach($news_En as $key => $new_En)--}}
{{--                                    <div class="productinfo text-center col-md-4">--}}
{{--                                        --}}{{--                                Xử lý dưới js--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="pagination"></div>--}}
{{--            </div>--}}
{{--        </div><!--features_items-->--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="pagination"></div>--}}



{{--<script src="{{asset('Eshopper/js/jquery.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/price-range.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/main.js')}}"></script>--}}

{{--<script>--}}
{{--    const locale = "{{ $locale }}";--}}
{{--    // Giả sử bạn có một mảng chứa tất cả bài viết--}}
{{--    const allNews = <?php echo json_encode($locale === 'vi' ? $news : $news_En); ?>;--}}
{{--    // Đảm bảo rằng $news_all chứa một mảng dữ liệu bài viết--}}

{{--    const itemsPerPage = 3; // Số bài viết trên mỗi trang--}}
{{--    let currentPage = 1; // Trang hiện tại--}}

{{--    function displayNews(page) {--}}
{{--        const startIndex = (page - 1) * itemsPerPage;--}}
{{--        const endIndex = startIndex + itemsPerPage;--}}
{{--        const paginatedNews = allNews.slice(startIndex, endIndex);--}}

{{--        // Hiển thị bài viết của trang hiện tại--}}
{{--        const productDiv = document.querySelector('.product-list');--}}

{{--        productDiv.innerHTML = '';--}}
{{--        paginatedNews.forEach(news => {--}}
{{--            const title = news.title--}}

{{--            const newsItem = `--}}
{{--               <div class="productinfo text-center col-md-4" data-id="${news.id}">--}}
{{--                      <h2>${title}</h2>--}}
{{--                    <img style="object-fit: cover" src="{{ asset('storage/images/') }}/${news.thumbnail}" alt=""/>--}}
{{--                       <a class="all_information" href="#" onclick="showDetails(${news.id})">{{ trans('messages.detail') }}</a>--}}
{{--            </div>--}}
{{--                </div>--}}
{{--            `;--}}
{{--            productDiv.innerHTML += newsItem;--}}
{{--        });--}}

{{--        // Hiển thị phân trang--}}
{{--        const totalPages = Math.ceil(allNews.length / itemsPerPage);--}}
{{--        const paginationDiv = document.querySelector('.pagination');--}}
{{--        paginationDiv.innerHTML = '';--}}

{{--        for (let i = 1; i <= totalPages; i++) {--}}
{{--            if (i === currentPage) {--}}
{{--                paginationDiv.innerHTML += `<a href="#" onclick="changePage(${i})" class="current">${i}</a>`;--}}
{{--            } else {--}}
{{--                paginationDiv.innerHTML += `<a href="#" onclick="changePage(${i})">${i}</a>`;--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}
{{--    function showDetails(newsId) {--}}
{{--        // Chuyển hướng đến trang chi tiết bài viết với ID đã truyền vào--}}
{{--        const detailUrl = "{{ route('home.news_one', ['locale' => ':locale', 'id' => ':id']) }}"--}}
{{--            .replace(':locale', locale)--}}
{{--            .replace(':id', newsId);--}}
{{--        window.location.href = detailUrl;--}}
{{--    }--}}
{{--    function changePage(page) {--}}
{{--        currentPage = page;--}}
{{--        displayNews(currentPage);--}}
{{--    }--}}

{{--    // Hiển thị bài viết ban đầu khi trang được tải--}}
{{--    displayNews(currentPage);--}}
{{--</script>--}}

{{--</body>--}}
{{--</html>--}}




{{--<script src="{{asset('Eshopper/js/jquery.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/jquery.scrollUp.min.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/price-range.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/jquery.prettyPhoto.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/main.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/html5shiv.js')}}"></script>--}}
{{--<script src="{{asset('Eshopper/js/respond.min.js')}}"></script>--}}

{{--</body>--}}
{{--</html>--}}
