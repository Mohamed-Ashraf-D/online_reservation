@extends('layouts.admins')
@section('content')
    <div class="container mt-4">
        <h2>My Reservations</h2>

        <table class="table table-bordered mt-3">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>User Email</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->user->email }}</td>
                    <td>{{ $reservation->service->name ?? '-' }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->time_from }}</td>
                    <td>{{ $reservation->time_to }}</td>
                    <td>
                        {{ ucfirst($reservation->status) }}
                        @if($reservation->status !== 'done')
                            <form method="POST" action="{{ route('admins.reservation.done', $reservation->id) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Mark as Done</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No reservations found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
