<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display the booking form.
     */
    public function index()
    {
        return view('booking.create');
    }

    /**
     * Store a new appointment request.
     */
    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'type' => 'required|in:medical,psychology',
            'scheduled_at' => 'required|date|after:now', // Must be a future date
            'notes' => 'nullable|string|max:500',
        ]);

        // 2. Create Appointment
        Appointment::create([
            'user_id' => Auth::id(), // Link to logged-in student
            'type' => $request->type,
            'scheduled_at' => $request->scheduled_at,
            'notes' => $request->notes,
            'status' => 'pending' // Default status
        ]);

        // 3. Redirect to history page
        return redirect()->route('booking.history')->with('success', 'Appointment requested successfully!');
    }

    /**
     * Show the user's booking history.
     */
    public function history()
    {
        // Get appointments for the CURRENT user only
        $appointments = Appointment::where('user_id', Auth::id())
                                   ->orderBy('scheduled_at', 'desc')
                                   ->get();

        return view('booking.history', compact('appointments'));
    }
}
