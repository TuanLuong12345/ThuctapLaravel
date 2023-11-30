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
                <form class="col-md-9" action="{{ route('users.search') }}" method="get">
                    <div class="col-md-8">
                        <div class="d-flex form-inputs">
                            <input
                                class="form-control"
                                type="text"
                                name="search"
                                placeholder="Search...."
                                value="{{$search}}"
                            >
                            <button
                                type="submit"
                                class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5"
                                type="button">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>
                    </div>
                </form>
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="language_all language-select">
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
            <div id="content">
                <!-- End of Header -->
                <div class="content-wrapper">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('users.create')}}"
                                       class="btn btn-success float-right m-2" >
                                        Add
                                    </a>
                                    <button style="margin-bottom: 15px;"
                                            class="btn btn-danger delete_all"
                                            data-url="{{ route('usersDeleteAll') }}"
                                    >Delete All Selected
                                    </button>
                                    <div class="select_paginate" style="text-align: center; margin-top: -45px;margin-bottom: 20px">
                                        Hiển thị số lượng
                                        <select class="col-md-2" id="itemsPerPage"  onchange="updateItemsPerPage()">
                                            <option value="5" {{ $itemsPerPage==5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ $itemsPerPage==10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ $itemsPerPage==15 ? 'selected' : '' }}>15</option>
                                            <option value="20" {{ $itemsPerPage==20 ? 'selected' : '' }}>20</option>
                                        </select>
                                        kết quả / 1 trang
                                    </div>
                                    <a href="{{route('users.export_search')}}"
                                       style="background-color: #0000cc;display: block;"
                                       class="btn btn-success float-right m-2">
                                        Export  Search All
                                    </a>


                                    <form action="{{route('users.import')}}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="file"
                                               name="file"
                                               class="form-control col-md-6"
                                               required
                                        >
                                        <button  style="background-color:yellowgreen;margin-bottom: 10px;color: black"
                                                 class="btn float-left"
                                        >
                                            Import User Data
                                        </button>
                                        <br>
                                    </form>
                                    <form action="{{route('users.export_search_selected')}}"
                                          method="get"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="selected_ids" id="selected_ids" />
                                        <button  style="margin-bottom: 10px;margin-top: -10px;color: black" class="btn btn-warning float-right" type="submit">
                                            Export Search Selected
                                        </button>
                                        <br>
                                    </form>
                                </div>


                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="check_all">
                                                <input
                                                    type="checkbox"
                                                    id="master"
                                                >
                                            </th>
                                            <th scope="col" class="column">Id</th>
                                            <th scope="col" class="column">Tên User</th>
                                            <th scope="col" class="column">Email</th>
                                            <th scope="col" class="column">Phone</th>
                                            <th scope="col" class="column">Role</th>
                                            <th scope="col" class="column">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if($searchResults->isNotEmpty())
                                            @foreach ($searchResults as $searchResult)
                                                <tr>
                                                    <td><input
                                                            type="checkbox"
                                                            class="sub_chk"
                                                            data-id="{{$searchResult->id}}"
                                                        >
                                                    </td>
                                                    <th scope="row">{{$searchResult->id}}</th>
                                                    <td>{{$searchResult->name}}</td>
                                                    <td>{{$searchResult->email}}</td>
                                                    <td>{{$searchResult->phone}}</td>
                                                    <td>{{$searchResult->role}}</td>
                                                    <td  class="edit_delete">
                                                        <a href="{{route('users.edit',['id'=>$searchResult->id])}}"
                                                           class="btn btn-danger">
                                                            Edit
                                                        </a>
                                                        <a href="{{route('users.delete',['id'=>$searchResult->id])}}" class="btn btn-danger"
                                                           data-tr="tr_{{$searchResult->id}}"
                                                           data-toggle="confirmation"
                                                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                                           data-btn-ok-class="btn btn-sm btn-danger"
                                                           data-btn-cancel-label="Cancel"
                                                           data-btn-cancel-icon="fa fa-chevron-circle-left"
                                                           data-btn-cancel-class="btn btn-sm btn-default"
                                                           data-title="Are you sure you want to delete ?"
                                                           data-placement="left" data-singleton="true">
                                                            Delete
                                                        </a>
                                                        {{--                                            <a href="{{route('users.delete',['id'=>$user->id])}}"--}}
                                                        {{--                                               class="btn btn-danger action_delete">--}}
                                                        {{--                                                Delete--}}
                                                        {{--                                            </a>--}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <div>
                                                <h3 style="color: black;text-align: inherit">Không tìm thấy users thỏa mãn</h3>
                                            </div>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                                {{ $searchResults->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--//js deleted all--}}
            <script src="{{asset('js/users/delete_all.js')}}"></script>

            {{--   Js phân trang --}}
            <script src="{{asset('js/users/user_paginate.js')}}"></script>

{{--            Js Search->selected->export + checkall--}}
            <script src="{{asset('js/users/export_search_selected.js')}}"></script>

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
</div>
</body>

</html>


