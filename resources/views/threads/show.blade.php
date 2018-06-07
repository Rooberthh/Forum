@extends('layouts.app')

@section('content')
<thread-view inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                                {{$thread->title}}
                            </span>
                            @can('update', $thread)
                                <form method="POST" action="{{ $thread->path() }}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$thread->body}}</p>
                    </div>
                </div>
            <replies :data="{{$thread->replies}}"></replies>

                
            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach
            
            {{ $replies->links() }}

            @if(auth()->check())
                   <form class="mt-4" method="post" action="{{ $thread->path() }}/replies" >
                        {{csrf_field()}}
                        <div class="form-group">
                          <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" row="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Reply</button>
                   </form>

            @else
                <p class="text-center">Please <a href=" {{ route('login') }} ">sign in</a> to be able to reply to threads</p>
            @endif
          </div>

          <div class="col-md-4">
              <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a class="" href="#"> {{$thread->creator->name}}</a>, and currently 
                            has {{ $thread->replies_count}} {{ str_plural('reply', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
          </div>
        </div>
    </div>
</thread-view>
@endsection
