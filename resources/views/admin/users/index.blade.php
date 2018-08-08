@extends('admin.layout.app')

@section('administration-content')
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
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr class="border-bottom">
                            <td class="text-sm pt-4 pb-4 pr-4 border-b">{{ $user->name }}</td>
                            <td class="text-sm p-4 border-b">{{ $user->email }}</td>
                            <td class="text-sm p-4 border-b">{{ $user->reputation }}</td>
                            <td class="text-sm p-4 border-b">{{ $user->confirmed }}</td>
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
