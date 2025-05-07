@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.user')

@section('content')
    <div class="container mt-4">

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        <h2 class="mb-4">My Reservations</h2>

        @if($reservations->isEmpty())
            <div class="alert alert-info">You have no reservations yet.</div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reservation->service->name }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->time_from }}</td>
                        <td>{{ $reservation->time_to }}</td>
                        <td>
                            <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td>@php

                                $reservationDateTime = Carbon::parse($reservation->reservation_date . ' ' . $reservation->time_from);
                                $diffInHours = $reservationDateTime->diffInHours(now(), false); // false: لو التاريخ في الماضي بيرجع سالب
                            @endphp

                            @if($reservation->status == 'pending' && $diffInHours <= 24)
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
