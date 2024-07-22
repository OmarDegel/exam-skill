@extends('web.layout')
@section('title')
	Home
@endsection
@section('content')
		<!-- Home -->
		<div id="home" class="hero-area">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{asset("web/img/home-background.jpg")}})"></div>
			<!-- /Backgound Image -->

			<div class="home-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1 class="white-text">@lang('web.heroTitle')</h1>
							<p class="lead white-text">@lang('web.heroDesc')</p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Home -->

		<!-- Courses -->
		<div id="courses" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>@lang('web.popularExamTitle')</h2>
						<p class="lead">@lang('web.popularExamDesc')</p>
					</div>
				</div>
				<!-- /row -->

				<!-- courses -->
				<div id="courses-wrapper">

					<!-- row -->
					<div class="row">

						@foreach ($popularExams as $exam)
							
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="course">
								<a href="{{route("examShow",["id"=>$exam->id])}}" class="course-img">
									<img src="{{asset("uploads/$exam->img")}}" alt="">
									<i class="course-link-icon fa fa-link"></i>
								</a>
								<a class="course-title" href="{{route("examShow",["id"=>$exam->id])}}">{{$exam->name()}}</a>
								<div class="course-details">
									<span class="course-category">{{$exam->skill->name()}}</span>
								</div>
							</div>
						</div>
						@endforeach
						<!-- /single course -->

					</div>
					<!-- /row -->

				</div>
				<!-- /courses -->

				<div class="row">
					<div class="center-btn">
						{{-- <a class="main-button icon-button" href="{{route("categorys.show")}}">@lang("web.More Courses")</a> --}}
					</div>
				</div>

			</div>
			<!-- container -->

		</div>
		<!-- /Courses -->

		

		<!-- Contact CTA -->
		<div id="contact-cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{asset("web/img/cta.jpg")}})"></div>
			<!-- Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="white-text">@lang('web.contact')</h2>
						<p class="lead white-text">@lang('web.contactDesc')</p>
						<a class="main-button icon-button" href="{{route("contact")}}">@lang('web.contactBtn')</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact CTA -->

		
		@endsection
