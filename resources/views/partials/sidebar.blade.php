<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('login')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
    <span>
        @if($currentUser && $currentUser->role === 'admin')
            Admin:
        @else($currentUser && $currentUser->role === 'user')
            User:
        @endif
    </span>
            <span>
        @if($currentUser)
                    {{ $currentUser->name }}
                @endif
    </span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lí người dùng</span>
            </a>
        @endif
    </li>
    <li class="nav-item active">
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Tất cả bài viết</span>
            </a>
        @endif
    </li>

    <li class="nav-item active">

            <a class="nav-link" href="{{ route('user.news.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Bài viết của bạn</span>
            </a>
    </li>

    <li class="nav-item active">
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{route('admin.contact_admin')}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lý Liên Hệ</span>
            </a>
        @endif
    </li>
    <li class="nav-item active">
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{route('info.index')}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lý Info</span>
            </a>
        @endif
    </li>
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
