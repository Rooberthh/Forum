<div id="reply-{{$reply->id}}" class="card mt-3 mb-4">
    <div class="card-header">
    	<div class="level">
    		<h5 class="flex">
		        <a href="/profiles/{{ $reply->owner->name }}">
		            {{$reply->owner->name}}
		        </a>
		        {{$reply->created_at->diffForHumans()}}...
	        </h5>

	        <div>
	        	<form method="POST" action="/replies/{{ $reply->id }}/favorites">
	        		{{ csrf_field() }}
	        		<button type="submit" class="btn btn-secondary" {{ $reply->isFavorited() ? 'disabled' : ''}}>
	        			{{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
	        		</button>
	        	</form>
	        </div>
        </div>
    </div>
    <div class="card-body">
        <p>{{$reply->body}}</p>
    </div>
    @can('update', $reply)
	    <div class="card-footer">
	    	<form method="POST" action="/replies/{{ $reply->id }}">
	    		{{csrf_field()}}
	    		{{method_field('DELETE')}}
	    		<button type="submit" class="btn btn-danger btn-xs">Delete</button>
	    	</form>
	    </div>
    @endcan
</div>