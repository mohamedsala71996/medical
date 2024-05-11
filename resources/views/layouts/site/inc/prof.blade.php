<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>{{$settings->ar_title}}</title>
    <link rel="icon" href="{{asset('upload').'/'.$settings['logo']}}"  sizes="16x16">

    <link rel="stylesheet" href="{{url('/')}}/site/css/main.min.css">
    <link rel="stylesheet" href="{{url('/')}}/site/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/site/css/color.css">
    <link rel="stylesheet" href="{{url('/')}}/site/css/responsive.css">


</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

    @include('layouts.site.inc.topbar')
    <section>
        <div class="feature-photo"  >
            <figure >
                @if($user->banner)
                    <img style="max-height:300px" src="{{url('/'.$user->banner)}}">
                @else
                    <img src="{{url('/')}}/site/images/resources/timeline-1.jpg" alt="">
                @endif
            </figure>
            <div class="add-btn">
                <!--                <span>1205 followers</span>
                                <a href="#" title="" data-ripple="">Add Friend</a>-->
            </div>
            <form method="post" action="{{route('siteProfile.store')}}" class="edit-phto" enctype="multipart/form-data">
                @csrf
                <i class="fa fa-camera-retro"></i>
                <label class="fileContainer">
                    {{trans('main.Edit_Cover_Photo')}}
                    <input id="imageInput" name="banner" type="file"/>
                    <input type="hidden" name="submitted" value="true">
                    <input type="submit" id="submitButton" style="display: none;">
                </label>
            </form>
            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            <figure>
                                @if($user->image)
                                    <img src="{{url('/'.$user->image)}}">
                                @else
                                    <img src="{{url('/')}}/site/images/resources/user-avatar.jpg" alt="">
                                @endif
                                <form  method="post" action="{{route('siteProfile.store')}}" class="edit-phto" enctype="multipart/form-data">
                                    @csrf
                                    <i class="fa fa-camera-retro"></i>
                                    <label class="fileContainer">
                                        {{trans('main.Edit_Display_Photo')}}
                                        <input id="imageInput1" name="image" type="file"/>
                                        <input type="hidden" name="submitted" value="true">
                                        <input type="submit" id="submitButton1" style="display: none;">
                                    </label>
                                </form>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5>{{$user->name}}</h5>
                                    @if($user->type==1)
                                        <span>مستخدم</span>
                                    @else
                                        <span>طبيب</span>
                                    @endif

                                </li>
                                <li>
                                    <a class="active" href="time-line.html" title="" data-ripple="">time line</a>
                                    <a href="timeline-photos.html" title="" data-ripple="">Photos</a>
                                    <a class="" href="timeline-videos.html" title="" data-ripple="">Videos</a>
                                    <a class="" href="timeline-friends.html" title="" data-ripple="">Friends</a>
                                    <a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>
                                    <a class="" href="about.html" title="" data-ripple="">about</a>
                                    <a class="" href="#" title="" data-ripple="">more</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- top area -->

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            @include('layouts.site.inc.sidebar')
                            <div class="col-lg-6">
                                <div class="central-meta">
                                    <div class="about">
                                        <div class="personal">
                                            <h5 class="f-title"><i class="ti-info-alt"></i> Personal Info</h5>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            </p>
                                        </div>
                                        <div class="d-flex flex-row mt-2">
                                            <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left">
                                                <li class="nav-item">
                                                    <a href="#basic" class="nav-link" data-toggle="tab">Basic info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#location" class="nav-link" data-toggle="tab">location</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#work" class="nav-link active show" data-toggle="tab">work and education</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#interest" class="nav-link" data-toggle="tab">interests</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#lang" class="nav-link" data-toggle="tab">languages</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="basic">
                                                    <ul class="basics">
                                                        <li><i class="ti-user"></i>sarah grey</li>
                                                        <li><i class="ti-map-alt"></i>live in Dubai</li>
                                                        <li><i class="ti-mobile"></i>+1-234-345675</li>
                                                        <li><i class="ti-email"></i><a href="https://wpkixx.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3c4553494e515d55507c59515d5550125f5351">[email&nbsp;protected]</a></li>
                                                        <li><i class="ti-world"></i>www.yoursite.com</li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="location" role="tabpanel">
                                                    <label for="location" class="col-2 col-form-label">الموقع على الخريطة <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-10">
                                                        <input type="hidden" name="longitude" id="longitude" value=""/>
                                                        <input type="hidden" name="latitude" id="latitude" value=""/>
                                                        {!!$maps['maps']['html']!!}
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade active show" id="work" role="tabpanel">
                                                    <div>

                                                        <a href="#" title="">Envato</a>
                                                        <p>work as autohr in envato themeforest from 2013</p>
                                                        <ul class="education">
                                                            <li><i class="ti-facebook"></i> BSCS from Oxford University</li>
                                                            <li><i class="ti-twitter"></i> MSCS from Harvard Unversity</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="interest" role="tabpanel">
                                                    <ul class="basics">
                                                        <li>Footbal</li>
                                                        <li>internet</li>
                                                        <li>photography</li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="lang" role="tabpanel">
                                                    <ul class="basics">
                                                        <li>english</li>
                                                        <li>french</li>
                                                        <li>spanish</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.site.inc.leftside')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.site.inc.footer')


</div>
<div class="side-panel">
    <h4 class="panel-title">General Setting</h4>
    <form method="post">
        <div class="setting-row">
            <span>use night mode</span>
            <input type="checkbox" id="nightmode1"/>
            <label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Notifications</span>
            <input type="checkbox" id="switch22" />
            <label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Notification sound</span>
            <input type="checkbox" id="switch33" />
            <label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>My profile</span>
            <input type="checkbox" id="switch44" />
            <label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Show profile</span>
            <input type="checkbox" id="switch55" />
            <label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
        </div>
    </form>
    <h4 class="panel-title">Account Setting</h4>
    <form method="post">
        <div class="setting-row">
            <span>Sub users</span>
            <input type="checkbox" id="switch66" />
            <label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>personal account</span>
            <input type="checkbox" id="switch77" />
            <label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Business account</span>
            <input type="checkbox" id="switch88" />
            <label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Show me online</span>
            <input type="checkbox" id="switch99" />
            <label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Delete history</span>
            <input type="checkbox" id="switch101" />
            <label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
        </div>
        <div class="setting-row">
            <span>Expose author name</span>
            <input type="checkbox" id="switch111" />
            <label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
        </div>
    </form>
</div><!-- side panel -->

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/main.min.js"></script>
<script src="{{url('/')}}/site/js/script.js"></script>
<script type="text/javascript">
    document.getElementById('imageInput').addEventListener('change', function() {
        document.getElementById('submitButton').click();
    });  document.getElementById('imageInput1').addEventListener('change', function() {
        document.getElementById('submitButton1').click();
    });
</script>
<script>
    //map initial value
    var centreGot = false;
</script>
{!!$maps['maps']['js']!!}

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{url('/')}}/site/js/main.min.js"></script>
<script src="{{url('/')}}/site/js/script.js"></script>
<script src="{{url('/')}}/site/js/map-init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWvmlsDcvt_l6yFexo7Hhfwl3rb-mPe8Q"></script>
</body>


</html>
