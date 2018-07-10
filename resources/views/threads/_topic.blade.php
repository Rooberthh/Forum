{{-- If editing--}}
<div class="card" v-if="editing">
    <div class="card-header">
        <input class="form-control" type="text" title="title" name="title" id="title" v-model="form.title">
    </div>
    <div class="card-body">
        <div class="form-group">
            <textarea name="body" id="body" class="form-control" rows="10" v-model="form.body">
            </textarea>
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

<div class="card" v-else>
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
                <span v-text="title"></span>
            </span>
        </div>
    </div>
    <div class="card-body" v-text="body">
    </div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-sm btn-info" @click="editing = true">Edit</button>
    </div>
</div>
