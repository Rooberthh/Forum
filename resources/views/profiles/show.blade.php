@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(auth()->id() == $user->id)
                    @include('profiles.settings._settings');
                @endif
            </div>

            <div class="col-md-9 order-md-1 order-lg-2">
                <div class="page-header">
                    <avatar-form :user="{{ $user }}"></avatar-form>
                </div>

                @forelse($activities as $date => $activity)
                    <h3 class="page-header"> {{ $date }} </h3>
                    <div class="list-group mt-2">
                        @foreach($activity as $record)
                            @if(view()->exists("profiles.activities.{$record->type}"))
                                @include("profiles.activities.{$record->type}", ['activity' => $record])
                            @endif
                        @endforeach
                    </div>
                    @empty
                    <p>No Activities For {{$user->name}} yet</p>
                @endforelse
            </div>
        </div>
	</div>
@endsection
