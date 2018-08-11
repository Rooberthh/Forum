{{-- If editing--}}
<div class="card mb-4" v-if="editing">
    <div class="card-header">
        <input class="form-control" type="text" title="title" name="title" id="title" v-model="form.title">
    </div>
    <div class="card-body">
        <div class="form-group">
            <wysiwyg name="body" v-model="form.body" :value="form.body"></wysiwyg>
        </div>
    </div>

    <div class="card-footer">
        <div class="level">
            <button class="btn btn-sm btn-info" @click="editing = true" v-show="!editing">Edit</button>
            <button class="btn btn-sm btn-primary" @click="update" v-show="editing">Update</button>
            <button class="btn btn-sm btn-danger ml-2" @click="resetForm">Cancel</button>

            @can ('update', $thread)
                <form action="{{ $thread->path() }}" method="POST" class="ml-auto">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>

{{-- If not editing--}}

<div class="card mb-4" v-else>
    <div class="card-body">
        <div class="level">
            <small class="flex">
                <span>Posted by: </span>
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }} ({{ $thread->creator->reputation }} XP)</a>
                <span>{{ $thread->created_at->diffForHumans() }}</span>
            </small>
            <a class="mx-1 action-link"  href="#" v-if="user.can['moderate']" @click="toggleLock" v-text="locked ? 'Unlock' : 'Lock'"></a>
            <a class="mx-1 action-link" href="#" v-if="user.can['moderate']" @click="togglePin" v-text="pinned ? 'Unpin' : 'Pin'"></a>
        </div>

        <h4 class="post-title-show" v-text="title"></h4>
        <div v-html="body"></div>
        <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>
    </div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-sm btn-info" @click="editing = true">Edit</button>
    </div>
</div>
