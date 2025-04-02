@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Yours domains</h2>
            @if($domains->isEmpty())
                <p>You don`t have any domains. Add new domain </p>
            @else
                <ul class="list-group mb-3">
                    @foreach($domains as $domain)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $domain->domain }}
                            <a href="{{ route('dashboard.domain.edit', $domain->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <h3>Add new domain</h3>
            <form method="POST" action="{{ route('dashboard.domain') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="domain" class="form-control" placeholder="Enter new domain (ex. google.com)">
                </div>
                <button type="submit" class="btn btn-primary">Save domain</button>
            </form>
        </div>
    </div>
@endsection
