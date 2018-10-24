<aside class="sidebar d-sm-none d-none d-md-block">
    <div class="card pr-4 py-4" id="sidebar-container">
        <div class="card-body">
            @if (auth()->check())
                @if(auth()->user()->confirmed)
                    <button class="btn btn-block is-green font-weight-bold" @click="$modal.show('new-thread')">Add New Thread</button>
                @else
                    <p class="p-3 border border-info">Please confirm your email address to participate.</p>
                @endif
            @else
                <button class="btn btn-primary btn-block" @click="$modal.show('login')">Log In To Post</button>
                <button class="btn btn-danger btn-block" @click="$modal.show('register')">Register</button>
            @endif

            <div class="mt-4">
                <h4 class="sidebar-heading">Browse</h4>
                <ul class="list-reset pl-0">
                    <li class="pb-1">
                        <i class="fas fa-book-open icon-grey"></i>
                        <a href="/threads" class="sidebar-link pl-2">
                            All Threads
                        </a>
                    </li>

                    @if (auth()->check())
                        <li class="pb-1">
                            <i class="fas fa-user icon-grey"></i>
                            <a href="/threads?by={{ auth()->user()->name }}"
                               class="sidebar-link pl-2"
                            >
                                My Threads
                            </a>
                        </li>
                    @endif

                    <li class="pb-1">
                        <i class="fas fa-star icon-grey"></i>
                        <a href="/threads?popular=1" class="sidebar-link pl-2">
                            Popular Threads
                        </a>
                    </li>

                    <li class="pb-1">
                        <i class="fas fa-question-circle icon-grey"></i>
                        <a href="/threads?unanswered=1" class="sidebar-link pl-2">
                            Unanswered Threads
                        </a>
                    </li>
                </ul>
            </div>
            @if(isset($trending) && count($trending))
            <div>
                <h4 class="sidebar-heading">Trending</h4>

                <ul class="list-reset pl-0">
                    @foreach($trending as $thread)
                        <li class="pb-3 text-sm">
                            <a href="{{ url($thread->path) }}" class="trending-link">
                                {{ $thread->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</aside>

