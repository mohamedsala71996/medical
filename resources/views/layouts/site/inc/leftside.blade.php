<div class="col-lg-3">
    <aside class="sidebar static">
        @if(auth::check())
        <div class="widget">
            <h4 class="widget-title">{{trans('main.MyProfile')}}</h4>
            <div class="your-page">
                <figure>
                    <a href="{{route('siteProfile.index')}}" title=""><img src="{{url('/'.auth()->user()->image)}}" alt=""></a>
                </figure>
                <div class="page-meta">
                    <a href="{{route('siteProfile.index')}}" title="" class="underline">{{trans('main.MyProfile')}}</a>
                    <span><i class="ti-comment"></i><a href="#" title="">{{trans('main.Groups')}} <em>9</em></a></span>
                    <span><i class="ti-bell"></i><a href="#" title="">{{trans('main.Notifications')}} <em>2</em></a></span>
                </div>
                <div class="page-likes">
<!--                    <ul class="nav nav-tabs likes-btn">
                        <li class="nav-item"><a class="active" href="#link1" data-toggle="tab">likes</a></li>
                        <li class="nav-item"><a class="" href="#link2" data-toggle="tab">views</a></li>
                    </ul>-->
                    <!-- Tab panes -->
<!--
                    <div class="tab-content">
                        <div class="tab-pane active fade show " id="link1" >
                            <span><i class="ti-heart"></i>884</span>
                            <a href="#" title="weekly-likes">35 new likes this week</a>
                            <div class="users-thumb-list">
                                <a href="#" title="Anderw" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-1.jpg" alt="">
                                </a>
                                <a href="#" title="frank" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-2.jpg" alt="">
                                </a>
                                <a href="#" title="Sara" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-3.jpg" alt="">
                                </a>
                                <a href="#" title="Amy" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-4.jpg" alt="">
                                </a>
                                <a href="#" title="Ema" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-5.jpg" alt="">
                                </a>
                                <a href="#" title="Sophie" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-6.jpg" alt="">
                                </a>
                                <a href="#" title="Maria" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-7.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="link2" >
                            <span><i class="ti-eye"></i>440</span>
                            <a href="#" title="weekly-likes">440 new views this week</a>
                            <div class="users-thumb-list">
                                <a href="#" title="Anderw" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-1.jpg" alt="">
                                </a>
                                <a href="#" title="frank" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-2.jpg" alt="">
                                </a>
                                <a href="#" title="Sara" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-3.jpg" alt="">
                                </a>
                                <a href="#" title="Amy" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-4.jpg" alt="">
                                </a>
                                <a href="#" title="Ema" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-5.jpg" alt="">
                                </a>
                                <a href="#" title="Sophie" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-6.jpg" alt="">
                                </a>
                                <a href="#" title="Maria" data-toggle="tooltip">
                                    <img src="{{url('/')}}/site/images/resources/userlist-7.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
-->
                </div>
            </div>
        </div><!-- page like widget -->
        @endif
        <div class="widget friend-list stick-widget">
            <h4 class="widget-title">{{trans('main.NearstDoctors')}}</h4>
            <div id="searchDir"></div>
            <ul id="people-list" class="friendz-list">
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
            <div class="chat-box">
                <div class="chat-head">
                    <span class="status f-online"></span>
                    <h6>Bucky Barnes</h6>
                    <div class="more">
                        <span><i class="ti-more-alt"></i></span>
                        <span class="close-mesage"><i class="ti-close"></i></span>
                    </div>
                </div>
                <div class="chat-list">
                    <ul>
                        <li class="me">
                            <div class="chat-thumb"><img src="{{url('/')}}/site/images/resources/chatlist1.jpg" alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                        <li class="you">
                            <div class="chat-thumb"><img src="{{url('/')}}/site/images/resources/chatlist2.jpg" alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                        <li class="me">
                            <div class="chat-thumb"><img src="{{url('/')}}/site/images/resources/chatlist1.jpg" alt=""></div>
                            <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                            </div>
                        </li>
                    </ul>
                    <form class="text-box">
                        <textarea placeholder="Post enter to post..."></textarea>
                        <div class="add-smiles">
                            <span title="add icon" class="em em-expressionless"></span>
                        </div>
                        <div class="smiles-bunch">
                            <i class="em em---1"></i>
                            <i class="em em-smiley"></i>
                            <i class="em em-anguished"></i>
                            <i class="em em-laughing"></i>
                            <i class="em em-angry"></i>
                            <i class="em em-astonished"></i>
                            <i class="em em-blush"></i>
                            <i class="em em-disappointed"></i>
                            <i class="em em-worried"></i>
                            <i class="em em-kissing_heart"></i>
                            <i class="em em-rage"></i>
                            <i class="em em-stuck_out_tongue"></i>
                        </div>
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div><!-- friends list sidebar -->
    </aside>
</div><!-- sidebar -->
