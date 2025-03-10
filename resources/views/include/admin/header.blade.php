<nav class="navbar navbar-expand navbar-light bg-white">
    <a class="sidebar-toggle d-flex mr-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                    @if(!empty(Auth::check() && Auth::user()->profile))
                        <img src="{{ asset('storage/app/public/user/'.Auth::user()->profile) }}"
                            class="avatar img-fluid rounded-circle mr-1" alt="Super Admin" />
                    @else
                        <img src="{{ asset('public/admin/img/avatars/avatar.jpg') }}"
                            class="avatar img-fluid rounded-circle mr-1" alt="Super Admin" />
                    @endif
                    <span class="text-dark">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ URL::to('admin/edit/profile') }}"><i
                            class="align-middle mr-1" data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ URL::to('admin/logout') }}">Sign out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
