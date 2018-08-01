@extends('layouts.app')

@section('sidebar')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn" href="{{ route('admin.channels.index') }}">Channels</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn" href="{{ route('admin.channels.create') }}">New Channel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
@endsection

@section('content')
    <div class="py-6">
        @yield('administration-content')
    </div>
@endsection
