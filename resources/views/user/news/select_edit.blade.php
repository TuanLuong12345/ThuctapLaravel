@extends('layout.admin')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'/>
@section('content')

    <div class="nav flex-column nav-pills"
         id="v-pills-tab"
         role="tablist"
         aria-orientation="vertical">
        <a href="{{ route('user.news.index') }}" class="btn btn-secondary col-md-2"
           style="width: 81px;margin-bottom: 40px;" >
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <a class="nav-link "
           href="{{ route('user.news.edit', ['id' => $id, 'locale' => 'vi']) }}"
        >
            Edit My News VietNamese
        </a>
        <a class="nav-link "
           href="{{ route('user.news.edit', ['id' => $id, 'locale' => 'en']) }}"
        >
            Edit My News English
        </a>
    </div>
    <script>
        $(document).ready(function() {
            $(".nav-link").mouseenter(function() {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection
