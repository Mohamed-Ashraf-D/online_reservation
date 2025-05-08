<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Service;
use App\Models\ServiceReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = ServiceReservation::with('service')
            ->where('user_id', auth()->id())
            ->orderBy('reservation_date', 'desc')
            ->get();

        return view('user.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $services = Service::where('is_available', true)->get();
        return view('user.reservations.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'time_from' => 'required|date_format:H:i',
//            'time_to' => 'required|date_format:H:i|after:time_from',
        ]);

        $timeFrom = Carbon::createFromFormat('H:i', $request->time_from);
        $timeTo = $timeFrom->copy()->addHour();
        if($request->service_id == 2){
            $targetRoles = 'user_consultation';
        }
        elseif($request->service_id == 3){
            $targetRoles = 'user_repairs';
        }
        elseif($request->service_id == 4){
            $targetRoles = 'user_coaching';
        }else{
            $targetRoles = ['user_consultation', 'user_repairs', 'user_coaching'];

        }

        $adminIds = Admin::role($targetRoles)->pluck('id')->toArray();

        $reservationDate = Carbon::parse($request->reservation_date)->startOfDay();
        $today = Carbon::today();

        if ($reservationDate->lt($today)) {
            return back()->with('error', 'Reservation date cannot be in the past.');
        }

        foreach ($adminIds as $adminId) {
            $currentDate = Carbon::today()->format('Y-m-d');
            $exists=ServiceReservation::where(['admin_id' => $adminId,'service_id'=>$request->service_id,'reservation_date'=>$request->reservation_date,'time_from' => $timeFrom])->
            where('status', '!=', 'done');

            if(!$exists->exists()){
                ServiceReservation::create([
                    'user_id' => auth()->id(),
                    'admin_id' => $adminId,
                    'service_id' => $request->service_id,
                    'reservation_date' => $request->reservation_date,
                    'time_from' => $timeFrom->format('H:i'),
                    'time_to' => $timeTo->format('H:i'),
                    'status' => 'pending',
                ]);
                break;
            }else{
                return redirect()->route('reservations.index')->with('error', 'try another date!');
            }
        }


        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }

    public function cancel($id)
    {
        $reservation = ServiceReservation::findOrFail($id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservationDateTime = Carbon::parse($reservation->reservation_date . ' ' . $reservation->time_from);
        $after24Hours = $reservationDateTime->addHours(24);

        $passed24Hours = now()->greaterThanOrEqualTo($after24Hours);
        if ($passed24Hours) {
            return redirect()->back()->with('error', 'Cannot cancel reservation that passed 24 hour from booking time.');
        }

        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }



}
