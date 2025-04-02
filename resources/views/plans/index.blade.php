@extends('layouts.app')

@section('content')
    <h2>Available Plans</h2>
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $plan->plan_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">${{ $plan->price }}</h6>
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($plan->features as $key => $value)
                                @if(is_string($key))
                                    <li class="list-group-item">{{ $key }}: {{ $value }}</li>
                                @else
                                    <li class="list-group-item">{{ $value }}</li>
                                @endif
                            @endforeach
                        </ul>
                        <form method="POST" action="{{ route('plans.buy', $plan->id) }}" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
