@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(isset($searched))
                <img src="{{ asset('images/algolia.png') }}" alt="algolia">
            @endif

            @include('threads._list')
            <div class="mt-4">
                {{ $threads->render() }}
            </div>
        </div>
    </div>
@endsection
