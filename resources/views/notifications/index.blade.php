@extends('layouts.site.inc.layouts')
@section('style')
<link rel="icon" href="{{asset('upload').'/'.$settings['logo']}}"  sizes="16x16">

<link rel="stylesheet" href="{{url('/')}}/site/css/main.min.css">
<link rel="stylesheet" href="{{url('/')}}/site/css/style.css">
<link rel="stylesheet" href="{{url('/')}}/site/css/color.css">
<link rel="stylesheet" href="{{url('/')}}/site/css/responsive.css">

@endsection
@section('content')
<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">

							<div class="col-lg-9">
								<div class="central-meta">
									<div class="editing-interest">
										<h5 class="f-title"><i class="ti-bell"></i>All Notifications </h5>
										<div class="notification-box">
											<ul>
                                                @foreach ($notifications as $notification)

												<li>
{{-- {{dd($notification)}} --}}
													<div class="notifi-meta">
														<a href={{$notification->data['link']}}>{{$notification->data['message']}}</a>
														<span>{{$notification->created_at->format('Y-m-d')}}</span>
													</div>
													<i class="del fa fa-close"></i>
												</li>
                                                @endforeach

											</ul>
										</div>
									</div>
								</div>
							</div><!-- centerl meta -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
