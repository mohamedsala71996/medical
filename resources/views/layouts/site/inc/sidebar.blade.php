<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">{{trans('main.Shortcuts')}}</h4>
            <ul class="naves">
                <li>
                    <i class="ti-clipboard"></i>
                    <a href="{{url('posts/create')}}" title="{{trans('main.NewPost')}}">{{trans('main.NewPost')}}</a>
                </li>
                <li>
                    <i class="ti-mouse-alt"></i>
                    <a href="{{url('/')}}" title="{{trans('main.Home')}}">{{trans('main.Home')}}</a>
                </li>
                <li>
                    <i class="ti-files"></i>
                    <a href="{{url('/profile')}}" title="{{trans('main.MyProfile')}}">{{trans('main.MyProfile')}}</a>
                </li>

                <li>
                    <i class="ti-comments-smiley"></i>
                    <a href="{{url('/group/create')}}"
                        title="{{trans('main.CreateGroup')}}">{{trans('main.CreateGroup')}}</a>
                </li>
                @auth
                <li>
                    <i class="ti-bell"></i>
                    <a href="{{url('/Notifications')}}"
                        title="{{trans('main.Notifications')}}">{{trans('main.Notifications')}}
                        <span id='notifications_count'>{{auth()->user()->unreadNotifications->count()}}</span><i
                            class="ti-bell"></i>
                    </a>
                </li>
                <li>

                    <form action="{{url('/logout')}}" method="post">
                        @csrf
                        <button type="submit" class="active"> {{trans('main.Logout')}} <i
                                class="ti-power-off"></i></button>
                    </form>
                </li>
                @endauth

                <li>
                    <i class="ti-share"></i>
                    <form action="{{route('askForHelp')}}" method="post">
                        @csrf
                        <button type="submit" class="active"> {{trans('main.AskHelp')}} </button>
                    </form>
                    {{-- <a href="{{route('askForHelp')}}"
                        title="{{trans('main.AskHelp')}}">{{trans('main.AskHelp')}}</a> --}}
                </li>


            </ul>
        </div><!-- Shortcuts -->
        <!--
        <div class="widget">
            <h4 class="widget-title">Recent Activity</h4>
            <ul class="activitiez">
                <li>
                    <div class="activity-meta">
                        <i>10 hours Ago</i>
                        <span><a href="#" title="">Commented on Video posted </a></span>
                        <h6>by <a href="time-line.html">black demon.</a></h6>
                    </div>
                </li>
                <li>
                    <div class="activity-meta">
                        <i>30 Days Ago</i>
                        <span><a href="#" title="">Posted your status. “Hello guys, how are you?”</a></span>
                    </div>
                </li>
                <li>
                    <div class="activity-meta">
                        <i>2 Years Ago</i>
                        <span><a href="#" title="">Share a video on her timeline.</a></span>
                        <h6>"<a href="#">you are so funny mr.been.</a>"</h6>
                    </div>
                </li>
            </ul>
        </div>&lt;!&ndash; recent activites &ndash;&gt;
-->
        <div class="widget stick-widget">
            <h4 class="widget-title">{{trans('main.NearstDoctors')}}</h4>
            <ul class="followers">
                @foreach($doctors as $doctor)
                <li>
                    <figure>
                        <img src="{{asset($doctor->image)}}" alt="">
                        <span class="status f-online"></span>
                    </figure>
                    <div class="friendz-meta">
                        <a href="time-line.html">{{$doctor->name}}</a>
                        <i><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="13647a7d677661607c7f77766153747e727a7f3d707c7e">[email&#160;protected]</a></i>
                    </div>
                </li>
                @endforeach
            </ul>
        </div><!-- who's following -->
    </aside>
</div><!-- sidebar -->
