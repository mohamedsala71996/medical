<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->ar_title }}</title>
    <link rel="icon" href="{{ asset('upload') . '/' . $settings['logo'] }}" sizes="16x16">

    <link rel="stylesheet" href="{{ url('/') }}/site/css/main.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/site/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/site/css/color.css">
    <link rel="stylesheet" href="{{ url('/') }}/site/css/responsive.css">
    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">
        @include('layouts.site.inc.topbar')
        <section>
            <div class="feature-photo">
                <figure>
                    @if ($user->banner)
                        <img style="max-height:300px" src="{{ url('/' . $user->banner) }}">
                    @else
                        <img src="{{ url('/') }}/site/images/resources/timeline-1.jpg" alt="">
                    @endif
                </figure>
                <div class="add-btn"></div>
                <form method="post" action="{{ route('siteProfile.store') }}" class="edit-phto" enctype="multipart/form-data">
                    @csrf
                    <i class="fa fa-camera-retro"></i>
                    <label class="fileContainer">
                        {{ __('Edit Cover Photo') }}
                        <input id="imageInput" name="banner" type="file" />
                        <input type="hidden" name="submitted" value="true">
                        <input type="submit" id="submitButton" style="display: none;">
                    </label>
                </form>
                <div class="container-fluid">
                    <div class="row merged">
                        <div class="col-lg-2 col-sm-3">
                            <div class="user-avatar">
                                <figure>
                                    @if ($user->image)
                                        <img src="{{ url('/' . $user->image) }}">
                                    @else
                                        <img src="{{ url('/') }}/site/images/resources/empty.png" alt="">
                                    @endif
                                    <form method="post" action="{{ route('siteProfile.store') }}" class="edit-phto" enctype="multipart/form-data">
                                        @csrf
                                        <i class="fa fa-camera-retro"></i>
                                        <label class="fileContainer">
                                            {{ __('Edit Display Photo') }}
                                            <input id="imageInput1" name="image" type="file" />
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
                                        <h5>{{ $user->name }}</h5>
                                        @if ($user->type == 1)
                                            <span>{{ __('User') }}</span>
                                        @elseif(($user->type == 2))
                                            <span>{{ __('Doctor') }}</span>
                                        @else
                                            <span>{{ __('Nutrition Specialist') }}</span>
                                        @endif
                                    </li>
                                    {{-- <li>
                                        <a class="active" href="" title="" data-ripple="">{{ __('About Me') }}</a>
                                        <a class="" href="timeline-groups.html" title="" data-ripple="">{{ __('Groups') }}</a>
                                    </li> --}}
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
                                                <h5 class="f-title"><i class="ti-info-alt"></i> {{ __('Personal Info') }}</h5>
                                            </div>
                                            <div class="d-flex flex-row mt-2">
                                                <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left">
                                                    <li class="nav-item">
                                                        <a href="#basic" class="nav-link active" data-toggle="tab">{{ __('Basic Info') }}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="basic">
                                                        <ul class="basics">
                                                            <li><i class="ti-user"></i>{{ $data['user']->name }}</li>
                                                            <li><i class="ti-mobile"></i>{{ $data['user']->phone }}</li>
                                                            <li><i class="ti-email"></i>{{ $data['user']->email }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @include('layouts.site.inc.leftside') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.site.inc.footer')
    </div>
    <div class="side-panel">
        <h4 class="panel-title">{{ __('General Setting') }}</h4>
        <form method="post">
            <div class="setting-row">
                <span>{{ __('Use night mode') }}</span>
                <input type="checkbox" id="nightmode1" />
                <label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Notifications') }}</span>
                <input type="checkbox" id="switch22" />
                <label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Notification sound') }}</span>
                <input type="checkbox" id="switch33" />
                <label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('My profile') }}</span>
                <input type="checkbox" id="switch44" />
                <label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Show profile') }}</span>
                <input type="checkbox" id="switch55" />
                <label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
        <h4 class="panel-title">{{ __('Account Setting') }}</h4>
        <form method="post">
            <div class="setting-row">
                <span>{{ __('Sub users') }}</span>
                <input type="checkbox" id="switch66" />
                <label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Personal account') }}</span>
                <input type="checkbox" id="switch77" />
                <label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Business account') }}</span>
                <input type="checkbox" id="switch88" />
                <label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Show me online') }}</span>
                <input type="checkbox" id="switch99" />
                <label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Delete history') }}</span>
                <input type="checkbox" id="switch101" />
                <label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>{{ __('Expose author name') }}</span>
                <input type="checkbox" id="switch111" />
                <label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
    </div><!-- side panel -->

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="{{ url('/') }}/site/js/script.js"></script>
    <script type="text/javascript">
        document.getElementById('imageInput').addEventListener('change', function() {
            document.getElementById('submitButton').click();
        });
        document.getElementById('imageInput1').addEventListener('change', function() {
            document.getElementById('submitButton1').click();
        });
    </script>
    <script>
        //map initial value
        var centreGot = false;
    </script>
    {{-- {!!$maps['maps']['js']!!} --}}

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/main.min.js"></script>
    {{-- <script src="{{ url('/') }}/site/js/main.min.js"></script> --}}
    <script src="{{ url('/') }}/site/js/script.js"></script>
    <script src="{{ url('/') }}/site/js/map-init.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWvmlsDcvt_l6yFexo7Hhfwl3rb-mPe8Q"></script>
</body>
</html>
