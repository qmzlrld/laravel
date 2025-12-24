<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->latest()->paginate(10);

        return view('profile', [
            'user' => $user,
            'bookings' => $bookings,
            'statusLabels' => Booking::statusLabels(),
        ]);
    }
}
