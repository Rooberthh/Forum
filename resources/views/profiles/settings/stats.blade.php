@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-3 order-2">
            @if(auth()->id() == $user->id)
                @include('profiles.settings._settings')
            @endif
        </div>

        <div class="col-sm-12 col-lg-9 order-1 order-lg-2">
            <h2 class="">Threads Created Per Month</h2>
            <thread-graph url="/api/user/graph"></thread-graph>
        </div>
    </div>
</div>
@endsection
