@extends('web.layout')
@section('title')
	Exams -{{$exam->name()}}
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
							<li><a href="index.html">@lang("web.home")</a></li>
							<li><a href="category.html">{{$exam->skill->cat->name()}}</a></li>
							<li><a href="category.html">{{$exam->skill->name()}}</a></li>
							<li>{{$exam->name()}}</li>
						</ul>
						<h1 class="white-text">{{$exam->name()}}</h1>
						<ul class="blog-post-meta">
							<li>{{ $exam->created_at->format('d F') }}</li>
							<li class="blog-meta-comments"><i class="fa fa-users"></i> {{$exam->studentCount()}}</a></li>
						</ul>
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
					<div id="main" class="col-md-9">
						@include('web.inc.message')
						<!-- blog post -->
						<div class="blog-post mb-5">
							<p>
								{{ $exam->desc() }}
                            </p>       
						</div>
						<!-- /blog post -->
                        
                        <div>
							
								@if ( $canEnter == true)
									<form action="{{route("exam.start",["id"=>$exam->id])}}">
										@csrf
										<button type="submit" class="main-button icon-button pull-left">{{__('web.StartExamBtn')}}</a>
									</form>
								@endif
							
						</div>
					</div>
					<!-- /main blog -->
                    
					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- exam details widget -->
                        <ul class="list-group">
                            <li class="list-group-item">Skill:{{ $exam->skill->name() }}</li>
                            <li class="list-group-item">Questions:{{ $exam->question_no }}</li>
                            <li class="list-group-item">{{ $exam->duration_mins }}</li>
                            <li class="list-group-item">Difficulty: 
								@for($i = 1; $i <= 5; $i++)
									@if ($i <=$exam->difficulty)
										<i class="fa fa-star"></i>
									@else
										<i class="fa fa-star-o"></i>
									@endif
								@endfor
                                {{-- <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i> --}}
                            </li>
                        </ul>
						<!-- /exam details widget -->

						

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

		@endsection