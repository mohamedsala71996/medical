<nav class="sidebar sidebar-offcanvas {{ get_slider_bg(admin()->user()) }} " id="sidebar">
    <ul class="nav">

        {{-- Profile --}}
        <li class="nav-item nav-profile">
            <a href="{{ route('profile.edit', admin()->user()->id) }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ get_file(admin()->user()->image) }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ admin()->user()->name }}</span>
                    <span class="text-secondary text-small">مدير النظام</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">الرئيسية</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        {{-- Settings --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">الإعدادت</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('setting.edit', 1) }}">معلومات الموقع</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('siteTexts.index') }}">معلومات النظام</a> --}}
                    </li>
                    {{--
                    <li class="nav-item"> <a class="nav-link" href="{{route('adminEmails.index')}}">ارسال بريد الكترونى</a></li>
--}}
                    {{--
                    <li class="nav-item"> <a class="nav-link" href="{{route('FirebaseNotification.index')}}">إضافة إشعار</a></li>
--}}
                    {{--
                    <li class="nav-item"> <a class="nav-link" href="{{route('sliders.index')}}">صور البانر</a></li>
--}}
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('socials.index') }}">حسابات السوشيل
                            ميديا</a></li> --}}
                </ul>
            </div>
        </li>
        {{-- Admins --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admins.index') }}">
                <span class="menu-title">مديرو النظام</span>
                <i class="mdi mdi-console menu-icon"></i>
            </a>
        </li>




        {{-- users --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <span class="menu-title">العملاء</span>
                <i class="mdi mdi-nature-people menu-icon"></i>
            </a>
        </li>
        {{-- drivers --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('drivers.index') }}">
                <span class="menu-title">الاطباء ومثقفي السكري</span>
                <i class="mdi mdi-factory menu-icon"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('terms.index') }}">
                <span class="menu-title">الشروط والأحكام</span>
                <i class="mdi mdi-factory menu-icon"></i>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_locations') }}">
                <span class="menu-title">الخريطة</span>
                <i class="mdi mdi-map menu-icon"></i>
            </a>
        </li> --}}

        {{-- new Markets --}}
        {{--        <li class="nav-item">
            <a class="nav-link" href="{{route('newDrivers.index')}}">
                <span class="menu-title">طلبات السائقين الجديدة</span>
                <i class="mdi mdi-newspaper menu-icon"></i>
            </a>
        </li --}}>

        <!--       <li class="nav-item">
            <a class="nav-link" href="{{ route('cars.index') }}">
                <span class="menu-title">السيارت</span>
                <i class="mdi mdi-car-back menu-icon"></i>
            </a>
        </li>-->

        <!--
        <li class="nav-item">
            <a class="nav-link" href="{{ route('wallets.index') }}">
                <span class="menu-title">المحفظات </span>
                <i class="mdi mdi-factory menu-icon"></i>
            </a>
        </li> <li class="nav-item">
            <a class="nav-link" href="{{ route('prices.index') }}">
                <span class="menu-title"> سعر الكيلومتر</span>
                <i class="mdi mdi-fax menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('allOrders.index') }}">
                <span class="menu-title">الطلبات</span>
                <i class="mdi mdi-stove menu-icon"></i>
            </a>
        </li>
-->


        {{-- Contacts --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('contacts.index') }}">
                <span class="menu-title">رسائل التواصل</span>
                <i class="mdi mdi-message-alert-outline menu-icon"></i>
            </a>
        </li> --}}
        {{-- End Links --}}
    </ul>
</nav>
