@extends('admin.layout.app')

@section('administration-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table style="border-collapse: collapse">
                    <thead class="bg-grey-lightest text-grey-darkest uppercase tracking-wide text-xs">
                    <tr>
                        <th class="p-4 border-b" colspan="2">Name</th>
                        <th class="p-4 border-b">Slug</th>
                        <th class="p-4 border-b">Description</th>
                        <th class="p-4 border-b">Threads</th>
                        <th class="p-4 border-b" colspan="2">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($channels as $channel)
                        <tr class="border-b {{ $channel->archived ? 'bg-danger' : '' }}">
                            <td class="pl-4 pt-4 pb-4 border-b">
                                <span class="rounded-full inline-block h-3 w-3 mr-2" style="background: {{ $channel->color }}"></span>
                            </td>
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">{{ $channel->name }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->slug }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->description }}</td>
                            <td class="text-sm p-4 border-b">{{ $channel->threads->count() }}</td>
                            <td class="text-sm p-4 border-b">
                                <a href="{{ route('admin.channels.edit', $channel) }}" class="btn btn-outline-info">Edit</a>
                            </td>
                            <td class="text-sm p-4 border-b">
                                <form action="{{ route('admin.channels.destroy', $channel) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
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
