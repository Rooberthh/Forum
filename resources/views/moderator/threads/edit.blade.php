@extends('moderator.layout.app')

@section('moderator-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-2">
                <form action="{{ route('moderator.threads.update', [$thread->channel->id, $thread]) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="flex mb-4">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" value="{{ $thread->title }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="channel_id" class="form-label">Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value="">Choose one...</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ $thread->channel->id == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <wysiwyg name="body" value="{{ $thread->body }}"></wysiwyg>
                    </div>

                    <div class="d-flex">
                        <a href="{{ route('moderator.threads.index') }}" class="btn btn-danger mr-4 flex-grow-1">Cancel</a>
                        <button type="submit" class="btn btn-info flex-grow-1">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
