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

        {{--<subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>--}}
        {{--<button class="btn btn-outline-warning" v-if="authorize('isAdmin')" @click="toggleLock" v-text="locked ? 'Unlock' : 'Lock'"></button>--}}
        {{--<button class="btn btn-outline-info" v-if="authorize('isAdmin')" @click="togglePin" v-text="pinned ? 'Unpin' : 'Pin'"></button>--}}
    </div>
</thread-view>
@endsection
