<aside class="mt-4 ml-4 sidebar">
    <div class="card">
        <div class="card-body">
            @if (auth()->check())
                @if(auth()->user()->confirmed)
                    <button class="btn btn-primary btn-block" @click="$modal.show('new-thread')">Add New Thread</button>
                @else
                    <p class="p-3 border border-info">Please confirm your email address to participate.</p>
                @endif
            @else
                <button class="btn btn-primary btn-block" @click="$modal.show('login')">Log In To Post</button>
                <button class="btn btn-danger btn-block" @click="$modal.show('register')">Register</button>
            @endif

            <div class="mt-4">
                <h4 class="sidebar-heading">Browse</h4>

                <ul class="list-reset">
                    <li class="pb-3">
                        <a href="/threads" class="sidebar-link">
                            All Threads
                        </a>
                    </li>

                    @if (auth()->check())
                        <li class="pb-3">
                            <a href="/threads?by={{ auth()->user()->name }}"
                               class="sidebar-link"
                            >
                                My Threads
                            </a>
                        </li>
                    @endif

                    <li class="pb-3">
                        <a href="/threads?popular=1" class="sidebar-link">
                            Popular Threads
                        </a>
                    </li>

                    <li class="pb-3">
                        <a href="/threads?unanswered=1" class="sidebar-link">
                            Unanswered Threads
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if( isset($trending) && count($trending))
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="sidebar-heading">Trending Threads</h4>

                <ul class="list-reset">
                    @foreach($trending as $thread)
                        <li class="pb-3 text-sm has-ellipsis">
                            <a href="{{ url($thread->path) }}" class="sidebar-link">
                                {{ $thread->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</aside>

