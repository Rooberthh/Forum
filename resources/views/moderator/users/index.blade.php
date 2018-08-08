@extends('moderator.layout.app')

@section('moderator-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-2">
                <table style="border-collapse: collapse">
                    <thead>
                    <tr>
                        <th class="p-4 border-bottom">Name</th>
                        <th class="p-4 border-bottom">Email</th>
                        <th class="p-4 border-bottom">Reputation</th>
                        <th class="p-4 border-bottom">Confirmed</th>
                        <th class="p-4 border-bottom">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr class="border-bottom">
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">
                                @if($user->locked)
                                    <span><i class="fas fa-lock lock-active"></i></span>
                                @endif
                                {{ $user->name }}
                                {{ $user->locked }}
                            </td>
                            <td class="text-sm p-4 border-b">{{ $user->email }}</td>
                            <td class="text-sm p-4 border-b">{{ $user->reputation }}</td>
                            <td class="text-sm p-4 border-b">{{ $user->confirmed }}</td>
                            <td class="text-sm p-4 border-b">
                                @if(! $user->locked)
                                    <form action="{{ route('locked-users.store', $user) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-outline-warning" type="submit">Lock</button>
                                    </form>
                                @else
                                    <form action="{{ route('locked-users.store', $user) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-warning" type="submit">Unlock</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nothing here.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
