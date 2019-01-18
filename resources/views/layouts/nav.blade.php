{{-- Main Navigation bar --}}
<nav class="navbar navbar-expand-md main-navbar d-none d-md-block">
    <div class="container">
        <a class="navbar-brand nav-link" href="{{ url('/') }}">
            {{ config('app.name', 'Forum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <channel-dropdown></channel-dropdown>
            </ul>

            <!-- Right Side Of Navbar -->

            <form method="GET" action="/threads/search" class="flex-grow-1 mx-auto">
                <div class="input-group position-relative">
                    <input type="text" placeholder="Search..." name="q" class="form-control-lg form-control">
                    <button id="btn-search" class="btn" type="submit">Search</button>
                </div>
            </form>

            <a class="navbar-nav ml-auto">

                @if(! auth()->check())
                    <a href="#" class="nav-link" @click="$modal.show('register')">Sign Up</a>
                    <a href="#}" class="nav-link" @click="$modal.show('login')">Sign In</a>
                @endif

                <!-- Authentication Links -->
                @if(auth()->user())
                    @if(auth()->user()->hasRole('moderator') || auth()->user()->hasRole('Developer'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Dashboard <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->hasRole('Developer'))
                                    <a href="{{ route('moderator.dashboard.index') }}" class="dropdown-item">Moderator</a>
                                    <a href="{{ route('developer.dashboard.index') }}" class="dropdown-item">Developer</a>
                                @elseif(auth()->user()->hasRole('moderator'))
                                    <a href="{{ route('moderator.dashboard.index') }}" class="dropdown-item">Moderator</a>
                                @endif
                            </div>
                        </li>
                    @endif
                    <user-notifications></user-notifications>
                    <li class="nav-item dropdown ml-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle nav-user" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
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
                @endif
            </a>
        </div>
    </div>
</nav>

{{-- Mobile navigation --}}

<nav class="navbar navbar-expand-md main-navbar d-block d-md-none">
    <div class="container">
        <a class="navbar-brand nav-link" href="{{ url('/') }}">
            {{ config('app.name', 'Forum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNavbar" aria-controls=mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="mobileNavbar">

            <!-- Right Side Of Navbar -->

            <form method="GET" action="/threads/search" class="flex-grow-1 mx-auto">
                <div class="input-group position-relative">
                    <input type="text" placeholder="Search..." name="q" class="form-control-lg form-control">
                    <button id="btn-search" class="btn btn-search" type="submit">Search</button>
                </div>
            </form>

            <a class="navbar-nav ml-auto">

                @if(! auth()->check())
                    <a href="#" class="nav-link" @click="$modal.show('register')">Sign Up</a>
                    <a href="#" class="nav-link" @click="$modal.show('login')">Sign In</a>
                @endif

            <!-- Authentication Links -->
                @if(auth()->user())
                    <a href="{{ route('profile', auth()->user()) }}" class="nav-link">New Thread</a>
                    <a href="{{ route('profile', auth()->user()) }}" class="nav-link">Profile</a>
                    <a href="{{ route('settings.account', auth()->user()) }}" class="nav-link">Settings</a>
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                @endif
            </a>
        </div>
    </div>
</nav>
