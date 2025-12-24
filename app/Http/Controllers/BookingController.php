<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::check()
            ? Auth::user()->bookings()->latest()->take(5)->get()
            : collect();

        return view('home', [
            'bookings' => $bookings,
            'statusLabels' => Booking::statusLabels(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'guests' => ['required', 'integer', 'min:1', 'max:20'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        $reservationAt = Carbon::createFromFormat('Y-m-d H:i', $validated['date'].' '.$validated['time'])
            ->second(0);

        if ($reservationAt->isPast()) {
            return back()->withErrors(['date' => 'Дата и время не могут быть в прошлом.'])->withInput();
        }

        Booking::create([
            'user_id' => Auth::id(),
            'reservation_at' => $reservationAt,
            'guests' => $validated['guests'],
            'comment' => $validated['comment'] ?? null,
            'status' => Booking::STATUS_NEW,
        ]);

        return redirect()->route('profile')->with('success', 'Заявка отправлена. Ожидайте подтверждения.');
    }
}
