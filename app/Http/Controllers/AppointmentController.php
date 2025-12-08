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
        if (!Auth::user()->isDoctor()) {
        abort(403, 'Access denied. Doctor access required.');
        }

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

    public function cancel(Appointment $appointment)
    {
        // 1. Authorization: Ensure the student owns this appointment
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Prevent canceling if already completed
        if ($appointment->status === 'completed' || $appointment->status === 'canceled') {
            return back()->with('error', 'Cannot cancel an already completed or canceled session.');
        }

        // 3. Update status
        $appointment->status = 'canceled';
        $appointment->save();

        return back()->with('success', 'Appointment successfully canceled.');
    }
}
