@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8" v-cloak>
                @include('threads._topic')
                <replies @added="repliesCount++" @removed="repliesCount--"></replies>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a class="" href="#"> {{$thread->creator->name}}</a>, and currently
                        has <span v-text="repliesCount"></span> {{ str_plural('reply', $thread->replies_count) }}.
                    </p>
                    <p>
                        <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>

                        <button class="btn btn-outline-warning" v-if="authorize('isAdmin')" @click="toggleLock" v-text="locked ? 'Unlock' : 'Lock'"></button>

                        <button class="btn btn-outline-info" v-if="authorize('isAdmin')" @click="togglePin" v-text="pinned ? 'Unpin' : 'Pin'"></button>
                    </p>
                </div>
              </div>
          </div>
        </div>
    </div>
</thread-view>
@endsection
