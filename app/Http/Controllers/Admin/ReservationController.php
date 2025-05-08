<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function myReservations()
    {
        $reservations = ServiceReservation::with('user')
            ->where('admin_id', Auth::guard('admin')->id())
            ->latest()
            ->get();

        return view('admin.reservations.my', compact('reservations'));
    }

    public function markAsDone($id)
    {
        $reservation = ServiceReservation::where('admin_id', Auth::guard('admin')->id())
            ->where('id', $id)
            ->firstOrFail();

        $reservation->status = 'done';
        $reservation->save();

        return redirect()->route('admins.my.reservations')->with('success', 'Reservation marked as done.');
    }

    public function reject($id)
    {
        $reservation = ServiceReservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation has been rejected.');
    }
}
