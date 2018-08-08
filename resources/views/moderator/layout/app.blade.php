@extends('layouts.app')

@section('sidebar')
    <div class="card mt-4">
        <div class="card-body">
            <ul class="list-reset p-1 mt-4">
                <li class="mb-3">
                    <a class="sidebar-link" href="{{ route('moderator.dashboard.index') }}">Dashboard</a>
                </li>

                <li class="mb-3">
                    <a class="sidebar-link" href="{{ route('moderator.channels.index') }}">Channels</a>
                </li>

                <li class="mb-3">
                    <a class="sidebar-link" href="{{ route('moderator.users.index') }}">Users</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        <div class="container">
            @yield('moderator-content')
        </div>
    </div>
@endsection
