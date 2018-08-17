{{-- If editing--}}
<div class="card mb-2" v-if="editing">
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
            @if(auth()->user())
                @if(auth()->user()->can('update', $thread) || auth()->user()->hasPermissionTo('moderate'))
                    <form action="{{ $thread->path() }}" method="POST" class="ml-auto">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-link">Delete Thread</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>

{{-- If not editing--}}

<div class="card mb-2 border-0 " v-else>
    <div class="card-body thread-body-show">
        <h3 class="thread-title-show" v-text="title"></h3>
            <small>
                <span>Posted by </span>
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }} ({{ $thread->creator->reputation }} XP)</a>
                <span>{{ $thread->created_at->diffForHumans() }} |</span>
                <a class="mx-1 action-link"  href="#" v-if="authorize('can', 'moderate')" @click="toggleLock" v-text="locked ? 'Unlock |' : 'Lock |'"></a>

                <a class="mx-1 action-link" href="#" v-if="authorize('can', 'moderate')" @click="togglePin" v-text="pinned ? 'Unpin |' : 'Pin |'"></a>
                <a class="mx-1 action-link" href="#" v-if="authorize('can', 'moderate') || authorize('owns', thread)" @click="editing = true">Edit |</a>
                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>
            </small>
        <div class="mt-2 body-text" v-html="body"></div>
    </div>
</div>
