@extends('layouts.app')

@section('content')
<thread-view inline-template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('threads._list')

            {{$threads->render()}}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Search
                </div>
                <div class="card-body">
                    <form method="GET" action="/threads/search" >
                        <div class="form-group">
                            <input type="text" placeholder="Search..." name="q" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(count($trending))
                <div class="card">
                    <div class="card-header">
                        Trending Threads
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($trending as $thread)
                                <li class="list-group-item">
                                    <a href="{{ url($thread->path) }}}">
                                        {{ $thread->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</thread-view>
@endsection
