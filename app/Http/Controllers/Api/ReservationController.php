<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceReservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->reservations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date',
            'time_from' => 'required',
        ]);

        $reservation = ServiceReservation::create([
            'user_id' => $request->user()->id,
            'service_id' => $request->service_id,
            'reservation_date' => $request->reservation_date,
            'time_from' => $request->time_from,
            'time_to' => now()->parse($request->time_from)->addHour()->format('H:i'),
            'status' => 'pending',
        ]);

        return response()->json($reservation, 201);
    }
}
