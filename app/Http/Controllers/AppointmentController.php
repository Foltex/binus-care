<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'type' => 'required|in:medical,psychology',
            'scheduled_at' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // 2. Create Appointment
        Appointment::create([
            'user_id' => Auth::id(), 
            'type' => $request->type,
            'scheduled_at' => $request->scheduled_at,
            'notes' => $request->notes,
            'status' => 'pending' 
        ]);

        // 3. Redirect to history page
        return redirect()->route('booking.history')->with('success', 'Appointment requested successfully!');
    }

    public function history()
    {
        // Get appointments for the CURRENT user only
        $appointments = Appointment::where('user_id', Auth::id())->orderBy('scheduled_at', 'desc')->get();

        return view('booking.history', compact('appointments'));
    }

    public function adminIndex()
    {
    // 1. Authorization check
    if (!Auth::user()->isDoctor()) {
        abort(403, 'Access denied. Doctor access required.');
    }

    // 2. Fetch all appointments, newest first, eager load the user
    $allAppointments = Appointment::with('user')->orderBy('created_at', 'desc')->get();

    return view('admin.appointments.index', compact('allAppointments'));
    }

    public function confirm(Appointment $appointment)
    {
    // 1. Authorization check
    if (!Auth::user()->isDoctor()) {
        abort(403, 'Unauthorized action.');
    }

    // 2. Update status
    $appointment->status = 'confirmed';
    $appointment->save();

    return back()->with('success', 'Appointment confirmed successfully!');
    }
}
