@extends('layouts.app')

@section('header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a Thread</div>
                <div class="card-body">
                    <form action="/threads" method="POST">
                        {{ csrf_field() }}

                      <div class="form-group">
                        <label for="channel_id">Choose a channel:</label>
                        <select name="channel_id" id="channel_id" class="form-control" required>
                          <option value="">Choose One</option>
                          @foreach(App\Channel::all() as $channel)
                          <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>{{ $channel->name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
                      </div>

                      <div class="form-group">
                        <label for="body">Body:</label>
                        <wysiwyg name="body"></wysiwyg>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Publish</button>
                      </div>
                      @if(count($errors))
                        <ul class="alert alert-danger">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
