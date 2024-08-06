@extends('web.layout')
@section('title')
	Exams -{{$exam->name()}}
@endsection
@section('content')

@section('css')
<link href="{{asset("web/css/TimeCircles.css")}}" rel="stylesheet">

@endsection
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
							<li class="blog-meta-comments"><i class="fa fa-users"></i> 35</a></li>
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
						<form id="examSubmit" action="{{route("exam.submit",["id"=>$exam->id])}}" method="post">
						<!-- blog post -->
						@csrf
						<div class="blog-post mb-5">
							<p>
                @foreach ($questiones as $index=> $questione)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                    <h3 class="panel-title">{{$index +1}}- {{$questione->title}}?</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="answers[{{$questione->id}}]"  value="1" >
                                            {{$questione->option_1}}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="answers[{{$questione->id}}]"  value="2" >
                                            {{$questione->option_2}}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="answers[{{$questione->id}}]"  value="3" >
                                            {{$questione->option_3}}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="answers[{{$questione->id}}]"  value="4" >
                                            {{$questione->option_4}}
                                            </label>
                                        </div>
                                    </div>
                                </div>   
                                @endforeach
                                
                                


                                
                            </p>       
						</div>
						<!-- /blog post -->
                        
                        <div>
                            <button type="submit"  class="main-button icon-button pull-left">Submit</button>
                            <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
                        </div>
					</form>
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

						
						<div class="duration" data-timer="{{ $exam->duration_mins  * 60}}"></div>

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

		<!-- Footer -->
		@endsection
		@section('js')
		<script type="text/javascript" src="{{asset("web/js/TimeCircles.js")}}"></script>
<script>
		$(".duration").TimeCircles({
			time : {
				Days : {
					show : false
				}
			},
			count_past_zero: false
		}).addListener(function(unit,value,total){
			if(total<=0){
				$("#examSubmit").submit()
			}
		}) 
</script>
		@endsection