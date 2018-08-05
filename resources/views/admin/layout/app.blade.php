@extends('layouts.app')

@section('sidebar')
    <div class="card mt-4">
        <div class="card-body">
            <a href="{{ route('admin.channels.create') }}" class="btn btn-primary">New Channel</a>
            <ul class="list-reset p-1 mt-4">
                <li class="mb-3">
                    <a class="sidebar-link" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                </li>

                <li class="mb-3">
                    <a class="sidebar-link" href="{{ route('admin.channels.index') }}">Channels</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6">
        @yield('administration-content')
    </div>
@endsection
