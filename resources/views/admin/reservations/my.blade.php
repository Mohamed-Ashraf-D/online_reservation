@extends('layouts.admins')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">My Reservations</h2>

        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark text-center">
            <tr>
                <th>#</th>
                <th>User Email</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr class="text-center align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->user->email }}</td>
                    <td>{{ $reservation->service->name ?? '-' }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->time_from }}</td>
                    <td>{{ $reservation->time_to }}</td>
                    <td>
                        <span class="badge bg-{{ $reservation->status == 'done' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </td>
                    <td>
                        @if($reservation->status !== 'done' && $reservation->status !== 'cancelled')
                            <form method="POST" action="{{ route('admins.reservation.done', $reservation->id) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Mark as Done</button>
                            </form>
                        @endif
                        @if($reservation->status !== 'cancelled' && $reservation->status !== 'done')
                            <form method="POST" action="{{ route('admins.reservation.reject', $reservation->id) }}" class="d-inline ms-1">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-danger">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No reservations found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
