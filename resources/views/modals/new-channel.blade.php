@if(auth()->check())
<modal name="new-channel" height="auto" adaptive>
    <button type="button" class="close float-right p-2" aria-label="Close" @click="$modal.hide('new-channel')">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="p-5">
        <form action="{{ route('moderator.channels.store', $channel) }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Name:</label>
                <input type="text" class="form-control" id="title" name="name" value="{{ old($channel->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old($channel->description) }}" required>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ old($channel->color) }}" required>
            </div>

            <div class="form-group">
                <label for="archived">Status:</label>
                <select name="archived" id="archived" class="form-control">
                    <option value="0" {{ $channel->archived ? '' : 'selected' }}>Active</option>
                    <option value="1" {{ $channel->archived ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-danger flex-grow-1 mx-2" @click="$modal.hide('new-channel')">Cancel</button>
                <button type="submit" class="btn btn-primary flex-grow-1 mx-2">Create Channel</button>
            </div>
        </form>
    </div>
</modal>
@endif
