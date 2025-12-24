<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();
        $query = Booking::with('user')->latest();

        if ($request->filled('status') && in_array($status, Booking::statuses(), true)) {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('admin.bookings', [
            'bookings' => $bookings,
            'statusLabels' => Booking::statusLabels(),
            'currentStatus' => $status,
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Booking::statuses())],
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Статус заявки обновлен.');
    }
}
