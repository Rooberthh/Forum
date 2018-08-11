@extends('moderator.layout.app')

@section('moderator-content')
    <h1 class="text-center mb-3"> Dashboard </h1>
    <div class="row -mx-2" v-cloak>
        <div class="col-md-4">
            <dashboard-tile url="{{ route('moderator.threads.index') }}" btn-text="Threads">
                <i class="fas fa-pencil-alt icon-xl" slot="icon"></i>
                <h2 class="my-2" slot="title">Threads</h2>
                <p class="tile-body-text my-3" slot="body">Moderate, Lock, Pin threads.</p>
            </dashboard-tile>
        </div>

        <div class="col-md-4">
            <dashboard-tile url="{{ route('moderator.users.index') }}" btn-text="Users">
                <i class="fas fa-users icon-xl" slot="icon"></i>
                <h2 class="my-2" slot="title">Users</h2>
                <p class="tile-body-text my-3" slot="body">Moderate, Lock and see users.</p>
            </dashboard-tile>
        </div>

        <div class="col-md-4">
            <dashboard-tile url="{{ route('moderator.channels.index') }}" btn-text="Channels">
                <i class="fas fa-tags icon-xl" slot="icon"></i>
                <h2 class="my-2" slot="title">Channels</h2>
                <p class="tile-body-text my-3" slot="body">Edit, Delete and Archive channels</p>
            </dashboard-tile>
        </div>
    </div>
@endsection
