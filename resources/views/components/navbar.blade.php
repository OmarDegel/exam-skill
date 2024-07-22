<nav id="nav">
    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href="{{route("Home")}}">{{__('web.home')}}</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.categories') <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach ($cats as $cat)	
                <li><a href="{{route("category.show",["id"=>$cat->id])}}">{{$cat->name()}}</a></li>
                    {{-- @if (App::getlocale() == "en")
                    {{json_decode($cat->name)->en}}</a></li>
                    
                    @else
                    {{json_decode($cat->name)->ar}}
                    @endif --}}
                @endforeach
            </ul>
            <li><a href="{{route("contact")}}">{{__('web.contact')}}</a></li>
            @guest
            @if (Route::has('login'))
            <li><a href="{{ route('login') }}">{{__('web.sign in')}}</a></li>
            @endif
            @if (Route::has('register'))
            <li><a href="{{ route('register') }}">{{__('web.sign up')}}</a></li>
            @endif
            @else
            @auth
            <li><a href="{{ route('profile',["id"=>Auth::user()->id]) }}">@lang("web.profile")</a></li>
            @endauth
            @if (Auth::user()->role->name == "admin" or  Auth::user()->role->name == "superadmin")
            <li><a href="{{ route("dashHome") }}">@lang("web.dashboard")</a></li>

            @endif

            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest




            @if (App::getlocale() == "en")
            <li><a href="{{route("lang.set",["lang"=> "ar"])}}">ع</a></li>
            @else
            <li><a href="{{route("lang.set",["lang"=> "en"])}}">en</a></li>
            @endif
        </li>
    </ul>
</nav>


                        
                        
                            