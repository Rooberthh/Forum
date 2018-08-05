@if(auth()->check())
<modal name="new-thread" height="auto">
    <form action="POST" action="/threads" class="p-4">
        {{ csrf_field() }}

        <div class="flex mb-4">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="channel_id" class="form-label">Channel</label>
                <select name="channel_id" id="channel_id" class="form-control">
                    <option value="">Choose one...</option>

                    @foreach($channels as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                            {{ $channel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-5">
            <wysiwyg name="body"></wysiwyg>
        </div>

        <div class="d-flex">
            <a href="#" class="btn btn-danger mr-4 flex-grow-1" @click="$modal.hide('new-thread')">Cancel</a>
            <button type="submit" class="btn btn-primary flex-grow-1">Publish</button>
        </div>
    </form>
</modal>
@endif
