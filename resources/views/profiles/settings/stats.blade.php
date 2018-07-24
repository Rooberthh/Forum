@extends('layouts.app');

@section('content');
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="menu">
                <p class="menu-label">Profile</p>
                <div class="list-group">
                    <a href="{{ route('profile', $user->name) }}"
                       class="list-group-item list-group-item-action settings-list-item">Profile
                    </a>
                    <a href="{{ route('settings.account', $user->name) }}"
                       class="list-group-item list-group-item-action settings-list-item">Account
                    </a>
                    <a href="{{ route('settings.stats', $user->name) }}" class="list-group-item list-group-item-action settings-list-item active">My Stats</a>
                </div>
            </aside>
        </div>

        <div class="col-md-9">
            <div class="list-group-item d-flex flex-row">
                <div class="profile-image">
                    <img src="http://via.placeholder.com/75x75" alt="" class="profile-image">
                </div>
                <div class="flex-grow-1 post-data">
                    <div>
                        <span class="post-title">Post title is lit tho</span>
                    </div>

                    <div>
                        <small>Posted by namanan </small>

                        <small>three days ago</small>
                    </div>

                    <div>
                        <span><i class="fas fa-comment-alt"></i> 10 </span>
                        <span><i class="far fa-eye"></i> 42</span>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <p>lock</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
