@extends('layouts.user')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Available Services</h2>

        <div class="row">
            @forelse ($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text text-muted">{{ $service->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p>
                            <p class="card-text">
                            <span class="badge bg-{{ $service->is_available ? 'success' : 'secondary' }}">
                                {{ $service->is_available ? 'Available' : 'Not Available' }}
                            </span>
                            </p>
                            @if ($service->is_available)
                                <a href="{{ route('reservations.create', ['service_id' => $service->id]) }}" class="btn btn-primary">
                                    Reserve Now
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    No services found at the moment.
                </div>
            @endforelse
        </div>
    </div>
@endsection
