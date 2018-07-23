@extends('layouts.app');

@section('content');
	<div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="menu">
                    <p class="menu-label">Profile</p>
                    <div class="list-group">
                        <a href="{{ route('profile', $profileUser->name) }}"
                           class="list-group-item list-group-item-action settings-list-item active">Profile
                        </a>
                        <a href="{{ route('settings.account', $profileUser->name) }}"
                           class="list-group-item list-group-item-action settings-list-item">Account
                        </a>
                        <a href="" class="list-group-item list-group-item-action settings-list-item">My Stats</a>
                    </div>
                </aside>
            </div>

            <div class="col-md-9">
                <div class="page-header">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>

                @forelse($activities as $date => $activity)
                    <h3 class="page-header"> {{ $date }} </h3>
                        @foreach($activity as $record)
                            @if(view()->exists("profiles.activities.{$record->type}"))
                                @include("profiles.activities.{$record->type}", ['activity' => $record])
                            @endif
                        @endforeach
                    @empty
                    <p>No Activities For {{$profileUser->name}} yet</p>
                @endforelse
            </div>
        </div>
	</div>
@endsection
