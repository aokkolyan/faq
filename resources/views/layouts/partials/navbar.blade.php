<nav class="navbar" style="position: relative;z-index: 99999;background: #00A351;color: white;border-bottom: 1px solid #eee;  position: -webkit-sticky;position: sticky;top: 0;
padding: 5px; border: 2px solid #4CAF50;">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="{{ route('question') }}"><img src="{{asset('images/question2answer-qa-logo-white-454x40.png')}}" alt="image"
            style="max-height:29px; with:auto;vertical-align: bottom;
            max-width: 100%;
            height: auto !important"></a> --}}
         <a href="{{ route('question') }}" style="text-decoration: none;font-size: 28px;font-family: monospace; text-shadow:  0 0 3px #FF0000;">FAQ</a>   
        <a class="navbar-brand" href="{{ route('question') }}"><img src="{{asset('images/logo.png')}}" alt="image" style="width: 250px; display:none"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent ">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
        </div>
        {{-- <form action="{{ url('/question/search') }}" method="GET" class="d-flex" role="search">
            @csrf
            <input class="form-control me-2" name="search" type="text" placeholder="Search" style="margin-left: 550px"
                value="{{ request()->get('search') }}" autocomplete="off" aria-label="Search">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form><br> --}}
        @if (Route::has('login'))
            <div class=" top-0 right-0 px-6  sm:block">
                @auth
                    {{-- <a href="{{ url('/dashboard') }}"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                    <div class="dropdown" style="margin-bottom: 20px;margin-top:15px">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->Getfullname() }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}" style="display: none">Profile</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                           this.closest('form').submit();">
                                        Logout
                                    </a></li>
                            </form>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white-700 dark:text-gray-500 " style="list-style-type: none">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-white-700 white:text-white-500 ">Register</a>
                    @endif
                @endauth
            </div>
        @endif





    </div>

</nav>
