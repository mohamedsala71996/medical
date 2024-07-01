<div class="topbar stick">
    <div class="logo" >
        <a title="" href="{{url('/')}}"><img width="30" height="30" src="{{asset('upload').'/'.$settings['logo']}}" alt=""></a>
    </div>

    <div class="top-area">
        <ul class="">
            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link " href="{{url('siteProfile')}}">{{__('Profile')}}</a>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link " href="{{url('login')}}">{{__('login')}}</a>
                </li>

            @endif
            <li class="nav-item">
                <a class="nav-link " href="{{ route('localeChange', 'en') }}">
                    <img src="{{ asset('img/england.png') }}"
                    style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;"
                    title="English">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('localeChange', 'ar') }}">
                    <img class="al" src="{{ asset('img/eg.png') }}"
                    style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;"
                    title="عربي">
                </a>
            </li>

        </ul>


    </div>
</div><!-- topbar -->
