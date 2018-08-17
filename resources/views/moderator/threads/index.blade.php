@extends('moderator.layout.app')

@section('moderator-content')
        <div class="row">
            <div class="col">
                <table style="border-collapse: collapse">
                    <thead>
                    <tr>
                        <th class="p-4 border-bottom" colspan="2">Title</th>
                        <th class="p-4 border-bottom">Slug</th>
                        <th class="p-4 border-bottom">Creator</th>
                        <th class="p-4 border-bottom">Channel</th>
                        <th class="p-4 border-bottom" colspan="3">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($threads as $thread)
                        <tr class="border-bottom">
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">
                                @if($thread->locked)
                                    <span><i class="fas fa-lock lock-active"></i></span>
                                @endif
                            </td>
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">{{ $thread->title }}</td>
                            <td class="text-sm p-4 border-b">{{ $thread->slug }}</td>
                            <td class="text-sm p-4 border-b">{{ $thread->creator->name }}</td>
                            <td class="text-sm p-4 border-b">{{ $thread->channel->name }}</td>
                            <td class="text-sm p-4 border-b">
                                @if(!$thread->locked)
                                    <form action="{{ route('moderator.locked-threads.store', $thread) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class=" ml-1 btn btn-outline-warning btn-sm" type="submit">Lock</button>
                                    </form>
                                @else
                                    <form action="{{ route('moderator.locked-threads.destroy', $thread) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class=" ml-1 btn btn-outline-warning btn-sm" type="submit">Unlock</button>
                                    </form>
                                @endif
                            </td>
                            <td class="text-sm p-4 border-b">
                                <a href="{{ route('moderator.threads.edit', $thread) }}" class="btn btn-outline-info btn-sm">Edit</a>
                            </td>
                            <td class="text-sm p-4 border-b">
                                <form action="{{ route('moderator.threads.destroy', [
                                    'channel' => $thread->channel,
                                    'thread' => $thread
                                ]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class=" ml-1 btn btn-outline-danger btn-sm" type="submit">Delete</button>
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
