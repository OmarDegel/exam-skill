@extends('web.layout')
@section('title') 

 Category -{{$cat->name()}}
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
							<li>{{$cat->name()}}</li>
						</ul>
						<h1 class="white-text">{{$cat->name()}}</h1>

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

						<!-- row -->
						<div class="row">
							
							@foreach ($skills as $skill)
							<!-- single skill -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{route("skil.show",["id"=>$skill->id])}}" class="course-img">
										<img src="{{asset("uploads/$skill->img")}}" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{route("skil.show",["id"=>$skill->id])}}">{{$skill->name()}}</a>
									
								</div>
							</div>
							@endforeach
							<!-- /single skill -->

							

						</div>
						<!-- /row -->

						<!-- row -->
						<div class="row">

							<!-- pagination -->
							{{$skills->links("web.inc.pagination")}}
							<!-- pagination -->

						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- search widget -->
						<div class="widget search-widget">
							<form>
								<input class="input" type="text" name="search">
								<button><i class="fa fa-search"></i></button>
							</form>
						</div>
						<!-- /search widget -->

						<!-- category widget -->
						<div class="widget category-widget">
							<h3>{{__('web.categories')}}</h3>
							@foreach ($cats as $cat)
							<a class="category" href="{{route("category.show",["id"=>$cat->id])}}">{{$cat->name()}}<span>{{$cat->skills()->count()}}</span></a>
							@endforeach
						</div>
						<!-- /category widget -->
					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->
		@endsection
		
		
		