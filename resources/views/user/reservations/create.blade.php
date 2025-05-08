@extends('layouts.user')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4">Reserve a Service</h2>

        <form action="{{ route('reservations.store') }}" method="POST" class="card p-4 shadow">
            @csrf

            <!-- Select Service -->
            <div class="mb-3">
                <input type="hidden" name="service_id" id="service_id" value="{{ request('service_id') }}">
            </div>

            <!-- Reservation Date -->
            <div class="mb-3">
                <label for="reservation_date" class="form-label">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
            </div>

            <!-- Time From -->
            <div class="mb-3">
                <label for="time_from" class="form-label">Time From</label>
                <input type="time" name="time_from" id="time_from" class="form-control" required>
            </div>

            <!-- Time To -->
{{--            <div class="mb-3">--}}
{{--                <label for="time_to" class="form-label">Time To</label>--}}
{{--                <input type="time" name="time_to" id="time_to" class="form-control" required>--}}
{{--            </div>--}}

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Confirm Reservation</button>
        </form>
    </div>
@endsection
