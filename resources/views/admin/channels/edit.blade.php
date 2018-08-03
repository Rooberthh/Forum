@extends('admin.layout.app')

@section('administration-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit a Channel</div>
                    <div class="card-body">
                        <form action="{{ route('admin.channels.update', $channel) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}

                            <div class="form-group">
                                <label for="title">Name:</label>
                                <input type="text" class="form-control" id="title" name="name" value="{{ $channel->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $channel->description }}" required>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ $channel->color }}" required>
                            </div>

                            <div class="form-group">
                                <label for="archived">Status:</label>
                                <select name="archived" id="archived" class="form-control">
                                    <option value="0" {{ $channel->archived ? '' : 'selected' }}>Active</option>
                                    <option value="1" {{ $channel->archived ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
