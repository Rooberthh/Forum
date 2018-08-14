@extends('layouts.app')

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
        <div class="px-5" v-cloak>
            @include('threads._topic')
            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
        </div>
</thread-view>
@endsection
