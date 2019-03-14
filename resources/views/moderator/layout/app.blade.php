@extends('layouts.app')

@section('sidebar')
    {{--<div class="card mt-4">--}}
        {{--<div class="card-body">--}}
            {{--<ul class="list-reset p-1 mt-2">--}}
                {{--<li class="mb-3">--}}
                    {{--<a class="sidebar-link" href="{{ route('moderator.dashboard.index') }}">Dashboard</a>--}}
                {{--</li>--}}

                {{--<li class="mb-3">--}}
                    {{--<a class="sidebar-link" href="{{ route('moderator.channels.index') }}">Channels</a>--}}
                {{--</li>--}}

                {{--<li class="mb-3">--}}
                    {{--<a class="sidebar-link" href="{{ route('moderator.users.index') }}">Users</a>--}}
                {{--</li>--}}

                {{--<li>--}}
                    {{--<a class="sidebar-link" href="{{ route('moderator.threads.index') }}">Threads</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')
    @yield('moderator-content')
@endsection
