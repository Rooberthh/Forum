@extends('layouts.app')

@section('content')
<thread-view inline-template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('threads._list')

            {{$threads->render()}}
        </div>
    </div>
</div>
</thread-view>
@endsection
