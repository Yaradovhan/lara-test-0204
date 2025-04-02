@extends('layouts.app')

@section('content')
    <h2>Registered Users</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Domain</th>
            <th>Registered At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->domains->isNotEmpty())
                        @foreach($user->domains as $domain)
                            {{ $domain->domain }}@if(!$loop->last), @endif
                        @endforeach
                    @endif
                </td>
                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
