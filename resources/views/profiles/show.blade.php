@extends('layouts.app');

@section('content');
	<div class="container">
		<div class="col-md-8 offset-2">
			<div class="page-header">
				<h1>
					{{ $profileUser->name }}
					<small>since {{ $profileUser->created_at->diffForHumans() }}</small>
				</h1>
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

			{{-- {{ $threads->links() }} --}}
		</div>
	</div>
@endsection