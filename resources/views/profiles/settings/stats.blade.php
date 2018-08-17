@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-3 order-2">
            @if(auth()->id() == $user->id)
                @include('profiles.settings._settings')
            @endif
        </div>

        <div class="col-sm-12 col-lg-9 order-1 order-lg-2 mb-">
        </div>
    </div>
</div>
@endsection
