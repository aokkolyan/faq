<nav class="navbar" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('question') }}">FAQ</a>
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

            
        @if (Route::has('login'))
            <div class=" top-0 right-0 px-6  sm:block">
                @auth
                    {{-- <a href="{{ url('/dashboard') }}"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                    <div class="dropdown" style="margin-bottom: 20px">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->Getfullname() }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
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
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500  btn btn-info">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-white-700 dark:text-gray-500 btn btn-primary" style="display: none">Register</a>
                    @endif
                @endauth
            </div>
        @endif





    </div>

</nav>
