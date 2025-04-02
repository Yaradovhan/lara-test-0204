@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Edit domain</h2>
            <form method="POST" action="{{ route('dashboard.domain.update', $domain->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" name="domain" class="form-control" value="{{ old('domain', $domain->domain) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update domain</button>
            </form>
        </div>
    </div>
@endsection
