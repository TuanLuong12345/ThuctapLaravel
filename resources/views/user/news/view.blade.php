<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{--    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Header -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto" >
                    <li class="language-select">
                        <a class="language_en" href="{{ route('switch.language', ['locale' => 'en']) }}">
                            EN
                        </a>
                    </li>
                    <li class="language-select">
                        <a class="language_vi" href="{{ route('switch.language', ['locale' => 'vi']) }}">
                            VI
                        </a>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$currentUser->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{asset('img/undraw_profile.svg')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('user.profile',['id'=>$currentUser->id])}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{route('auth.logout')}}"
                               data-toggle="modal"
                               data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Header -->
            <div class="row my-3">
                <div class="col-lg-8 mx-auto">
                    <a href="{{ route('user.news.index') }}" class="btn btn-secondary mb-3" style="margin-left: -135px">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h3 class="text-light fw-bold">View Post</h3>
                        </div>
                        <div class="card-body p-4">

                            @if($locale ==='vi')

                                <div class="my-2">
                                    Title: <span>{{ $newsUserView->title }}</span>
                                </div>
                                <div class="my-2">
                                    Ảnh Minh Họa:

                                    <img class="thumbnail" src="{{asset('storage/images/'.$newsUserView->thumbnail)}}" alt="">

                                    <div class="form-group">
                                        <div class="my-2">
                                            Public At: <span>{{ $newsUserView->public_at }}</span>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        Status:
                                        @if($newsUserView->status == 1)
                                            Đã phê duyệt
                                        @else
                                            Đang chờ phê duyệt
                                        @endif
                                    </div>
                                    <div class="my-2">
                                        Status:
                                        @if($newsUserView->banner == 1)
                                            Là Banner
                                        @else
                                            Không phải Banner
                                        @endif
                                    </div>

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form6Example7">Content :</label>
                                    {!! $newsUserView->content !!}
                                </div>

                            @else
                                @if($newsUserViewEn == null)
                                    <tr>
                                        <td colspan="8">Không có phiên bản tiếng Anh cho bài viết này.</td>
                                    </tr>
                                @else
                                    <div class="my-2">
                                        Title: <span>{{ $newsUserViewEn->title }}</span>
                                    </div>
                                    <div class="my-2">
                                        Ảnh Minh Họa:

                                        <img class="thumbnail" src="{{asset('storage/images/'.$newsUserViewEn->thumbnail)}}" alt="">

                                        <div class="form-group">
                                            <div class="my-2">
                                                Public At: <span>{{ $newsUserViewEn->public_at }}</span>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            Status:
                                            @if($newsUserViewEn->status == 1)
                                                Đã phê duyệt
                                            @else
                                                Đang chờ phê duyệt
                                            @endif
                                        </div>
                                        <div class="my-2">
                                            Status:
                                            @if($newsUserViewEn->banner == 1)
                                                Là Banner
                                            @else
                                                Không phải Banner
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form6Example7">Content :</label>
                                        {!! $newsUserViewEn->content !!}
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        @include('partials.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
@include('partials.layout-modal')

<!-- Bootstrap core JavaScript-->
{{--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>--}}
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
{{--<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>--}}

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('js/showpassword.js')}}"></script>


<!-- Page level plugins -->
{{--<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>--}}

<!-- Page level custom scripts -->
{{--<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>--}}
{{--<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>--}}


</body>

</html>





