@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
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
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </p>
                    </div>
                </div>
          </div>
        </div>
    </div>
</thread-view>
@endsection
