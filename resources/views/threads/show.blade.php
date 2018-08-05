@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="row">
        <div class="col-9 offset-3" v-cloak>
            @include('threads._topic')
            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
        </div>

    </div>
</thread-view>
@endsection
