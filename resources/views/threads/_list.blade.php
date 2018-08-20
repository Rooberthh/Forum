@forelse($threads as $thread)
    <div class="d-flex flex-row thread-list-item">
        <div>
            <img src="{{ $thread->creator->avatar_path }}" alt="" class="profile-image">
        </div>
        <div class="flex-grow-1 post-data">
            <div>
                <a href="{{ $thread->path() }}" class="post-title">
                        @if(auth()->check() && $thread->hasUpdatesFor( auth()->user() ))
                        <strong> {{ $thread->title }} </strong>
                    @else
                        {{ $thread->title }}
                    @endif
                    </a>
            </div>

            <div>
                <small>Posted by: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> </small>

                <small>{{ $thread->created_at->diffForHumans() }}</small>
            </div>

            <div>
                <a href="{{ $thread->channel->path() }}" class="category-label">{{ $thread->channel->name }}</a>
                <small>
                    <span><i class="fas fa-comment-alt icon-dark-grey"></i> {{ $thread->replies_count }} </span>
                    <span><i class="far fa-eye icon-dark-grey"></i> {{ $thread->visits }}</span>
                </small>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center">
            @if($thread->locked)
                <span><i class="fas fa-lock lock-active"></i></span>
            @endif
            @if($thread->pinned)
                <span><i class="fas fa-thumbtack"></i></span>
            @endif
        </div>
    </div>
@empty
    <p>There are no Posts in this category!</p>
@endforelse
