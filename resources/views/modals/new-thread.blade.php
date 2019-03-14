@if(auth()->check())
<new-thread inline-template>
    <modal name="new-thread" height="auto" maxWidth="800px" adaptive>
        <button type="button" class="close float-right p-2" aria-label="Close" @click="$modal.hide('new-thread')">
            <span aria-hidden="true">&times;</span>
        </button>
        <section class="p-4">
            <div class="flex mb-4">
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" v-model="form.title" class="form-control">
                    <span class="text-danger" v-if="errors.title" v-text="errors.title[0]"></span>
                </div>

                <div class="form-group">
                    <label for="channel_id" class="form-label">Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control" v-model="form.channel_id">
                        <option value="">Choose one...</option>
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">
                                {{ $channel->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger" v-if="errors.channel_id" v-text="errors.channel_id[0]"></span>
                </div>
            </div>

            <div class="mb-5">
                <wysiwyg name="body" v-model="form.body"></wysiwyg>
                <span class="text-danger" v-if="errors.body" v-text="errors.body[0]"></span>
            </div>

            <div class="d-flex">
                <a href="#" class="btn btn-danger mr-4 flex-grow-1" @click="$modal.hide('new-thread')">Cancel</a>
                <button type="submit" class="btn btn-primary flex-grow-1" @click="addThread()">Publish</button>
            </div>
        </section>
    </modal>
</new-thread>
@endif
