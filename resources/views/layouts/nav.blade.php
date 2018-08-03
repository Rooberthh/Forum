<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Forum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="/threads/create">Create Thread</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Browse
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/threads">All Threads</a>
                            @if(auth()->check())
                            <a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">My Threads</a>
                            @endif
                            <a class="dropdown-item" href="/threads?popular=1">Popular Threads</a>
                            <a class="dropdown-item" href="/threads?unanswered=1">Unanswered Threads</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach(App\Channel::all() as $channel)
                            <a class="dropdown-item" href="/threads/{{ $channel->slug }}">{{$channel->name}}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <a class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @else
                    <form method="GET" action="/threads/search" class="mr-3">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="q" class="form-control">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>

                    <user-notifications></user-notifications>

                    @if(Auth()->check() && Auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-cog text-dark"></i></a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="/profiles/{{ auth()->user()->name }}">My Profile</a>
                            <a class="dropdown-item" href="/profiles/{{ auth()->user()->name }}/settings/account">Settings</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </a>
        </div>
    </div>
</nav>
