<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row {{get_nav_bg(admin()->user())}} ">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}"><img src="{{asset('upload').'/'.$settings['logo']}}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><i class="mdi mdi-home"></i></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        {{--Search --}}
        {{--<div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form>
        </div>--}}
        <ul class="navbar-nav navbar-nav-left">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{get_file(admin()->user()->image)}}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{admin()->user()->name}}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{route('profile.edit',admin()->user()->id)}}">
                        <i class="mdi mdi-cached mr-2 text-success"></i>الحساب الشخصى </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('profile.change.pass.view',admin()->user()->id)}}">
                        <i class="mdi mdi-textbox-password mr-2 text-success"></i>تغيير كلمة المرور</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout mr-2 text-primary"></i> تسجيل الخروج </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>

           {{-- <li class="nav-item dropdown">
                <a class="nav-link  @if($unread_payments > 0) count-indicator @endif " href="{{route('payments.index')}}" >
                    <i class="mdi mdi-bank"></i>
                    <span class="count-symbol bg-danger"></span>
                </a>
            </li>--}}
            <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-power"></i>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
       {{-- <div class="search-field d-none d-md-block ">
                <a class="d-flex align-items-center h-100" href="#">
                    <i class="mdi mdi-format-line-spacing"></i>
                </a>
        </div>--}}
    </div>
</nav>
