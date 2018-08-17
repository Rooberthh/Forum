@extends('layouts.app')

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
        <div class="thread_container" v-cloak>
            @include('threads._topic')
            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
        </div>
</thread-view>
@endsection
