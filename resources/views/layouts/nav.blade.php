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
                <channel-dropdown></channel-dropdown>
            </ul>

            <!-- Right Side Of Navbar -->
            <form method="GET" action="/threads/search" class="mr-3 flex-grow-1 mx-4">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="q" class="form-control">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <a class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(auth()->user())
                    <user-notifications></user-notifications>

                    @if(Auth()->check() && Auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator') || auth()->user()->hasRole('developer'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Dashboard <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->hasRole('developer'))
                                    <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">Admin</a>
                                    <a href="{{ route('moderator.dashboard.index') }}" class="dropdown-item">Moderator</a>
                                    <a href="{{ route('developer.dashboard.index') }}" class="dropdown-item">Developer</a>
                                @elseif(auth()->user()->hasRole('moderator'))
                                    <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">Admin</a>
                                    <a href="{{ route('moderator.dashboard.index') }}" class="dropdown-item">Moderator</a>
                                @elseif(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">Admin</a>
                                @endif
                            </div>
                        </li>

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
                @endif
            </a>
        </div>
    </div>
</nav>
