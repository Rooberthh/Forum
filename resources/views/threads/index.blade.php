@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(isset($searched))
                <img src="{{ asset('images/algolia.png') }}" alt="algolia">
            @endif

            @include('threads._list')

            {{ $threads->render() }}
        </div>
    </div>
@endsection
