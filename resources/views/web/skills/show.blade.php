@extends('web.layout')
@section('title')
	skills -{{$skill->name()}}
@endsection
@section('content')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{asset("web/img/home-background.jpg")}})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">{{__('web.home')}}</a></li>
							<li><a href="category.html">{{$skill->cat->name()}}</a></li>
							<li>{{$skill->name()}}</li>
						</ul>
						<h1 class="white-text">{{$skill->name()}}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-12">

						<!-- row -->
						<div class="row">

							<!-- single exam -->
							@foreach ($exams as $exam)
							<div class="col-md-3">
								<div class="single-blog">
									<div class="blog-img">
										<a href="{{route("examShow",["id"=>$exam->id])}}">
											<img src="{{asset("uploads/$exam->img")}}" alt="">
											
										</a>
									</div>
									<h4><a href="{{route("examShow",["id"=>$exam->id])}}">{{$exam->name()}}</a></h4>
									<div class="blog-meta">
										<span>{{ $exam->created_at->format('d F') }}</span>
										<div class="pull-right">
											<span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>{{$exam->studentCount()}}</a></span>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							<!-- /single exam -->

							

						</div>
						<!-- /row -->

						<!-- row -->
						<div class="row">

							<!-- pagination -->
							{{$exams->links("web.inc.pagination")}}

							<!-- pagination -->

						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

		@endsection
		
		