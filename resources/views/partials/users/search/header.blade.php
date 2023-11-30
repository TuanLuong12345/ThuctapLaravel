
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <form class="col-md-7" action="{{ route('users.search') }}" method="get">
         <div class="col-md-8">
            <div class="d-flex form-inputs">
                <input
                    class="form-control"
                    type="text"
                    name="search"
                    placeholder="Search...."
                >
                <button
                    type="submit"
                    class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
    </div>
    </form>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class=" language_all_search language-select" style="margin-left: -200px">
            <a class="language_en" href="{{ route('switch.language', ['locale' => 'en']) }}">
                EN
            </a>
        </li>
        <li class="language-select">
            <a class="language_vi" href="{{ route('switch.language', ['locale' => 'vi']) }}">
                VI
            </a>
        </li>
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
