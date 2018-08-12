@extends('developer.layouts.app')

@section('Developer')
    <div class="container">
        <div class="row">
            <div class="col md-3">
                <developer-tile url="api/developer/threads">
                    <h3 slot="title">Threads</h3>
                </developer-tile>
            </div>
            <div class="col md-3">
                <developer-tile url="api/developer/channels">
                    <h3 slot="title">Channels</h3>
                </developer-tile>
            </div>
            <div class="col md-3">
                <developer-tile url="api/developer/users">
                    <h3 slot="title">Users</h3>
                </developer-tile>
            </div>
            <div class="col md-3">
                <developer-tile url="api/developer/replies">
                    <h3 slot="title">Replies</h3>
                </developer-tile>
            </div>
        </div>
    </div>
@endsection
