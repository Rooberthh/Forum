@extends('moderator.layout.app')

@section('moderator-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-2">
                <table style="border-collapse: collapse">
                    <thead>
                    <tr>
                        <th class="p-4 border-bottom" colspan="2">Name</th>
                        <th class="p-4 border-bottom">Slug</th>
                        <th class="p-4 border-bottom">Description</th>
                        <th class="p-4 border-bottom">Threads</th>
                        <th class="p-4 border-bottom" colspan="2">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($channels as $channel)
                        <tr class="border-bottom {{ $channel->archived ? 'bg-danger' : '' }}">
                            <td class="pl-4 pt-4 pb-4 border-b">
                                <span class="rounded-full inline-block h-3 w-3 mr-2" style="background: {{ $channel->color }}"></span>
                            </td>
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">{{ $channel->name }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->slug }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->description }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->threads->count() }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('moderator.channels.edit', $channel) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('moderator.channels.destroy', $channel) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class=" ml-2 btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nothing here.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
