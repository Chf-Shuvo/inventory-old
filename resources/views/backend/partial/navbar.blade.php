<div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/home" class="logo">
                <span class="text-white"><img src="{{ asset('icons/logo.png') }}" alt="" height="32"> BIMS</span>
                <i><img src="{{ asset('icons/logo.png') }}" alt="" height="40"></i>
            </a>
        </div>
        <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
        <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="{{ asset('icons/boy.png') }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" style="color:white;"><i class="mdi mdi-power text-danger"></i>
                            {{ __(' Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>
        </nav>
    </div>
