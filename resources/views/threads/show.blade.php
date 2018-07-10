@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <a href="{{ route('profile', $thread->creator) }}">
                            <img src="{{ $thread->creator->avatar_path }}"
                              alt="{{ $thread->creator->name }}"
                              width="25"
                              height="25"
                              class="mr-1"/>
                            </a>

                            <span class="flex">
                             <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted:
                                {{ $thread->title }}
                             </span>

                            @can ('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$thread->body}}</p>
                    </div>
                </div>

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
                        </p>
                    </div>
                </div>
          </div>
        </div>
    </div>
</thread-view>
@endsection
