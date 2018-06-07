<reply :attributes="{{ $reply }}" inline-template v-cloak>
	<div id="reply-{{$reply->id}}" class="card mt-3 mb-4">
	    <div class="card-header">
	    	<div class="level">
	    		<h5 class="flex">
			        <a href="/profiles/{{ $reply->owner->name }}">
			            {{$reply->owner->name}}
			        </a>
			        {{$reply->created_at->diffForHumans()}}...
		        </h5>
		        @if(Auth::check())
		        <div>
		        	<favorite :reply="{{ $reply }}"></favorite>
		        </div>
		        @endif
	        </div>
	    </div>
	    <div class="card-body">
	    	<div v-if="editing">
	    		<div class="form-group">
	    			<textarea class="form-control" v-model="body"></textarea>
	    		</div>

	    		<button class="btn btn-primary btn-sm" @click="update">Update</button>
	    		<button class="btn btn-info btn-sm" @click="editing = false">Cancel</button>
	    	</div>

	    	<div v-else v-text="body">
	    	</div>
	    </div>
	    @can('update', $reply)
		    <div class="card-footer level">
		    	<button class="btn btn-info btn-xs mr-2 btn-sm" @click="editing = true">Edit</button>
		    	<button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
		    </div>
	    @endcan
	</div>
</reply>