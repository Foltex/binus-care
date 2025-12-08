<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ForumThread;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Appointment Statistics
        $pendingAppointments = $user->appointments()->where('status', 'pending')->count();
        $confirmedAppointments = $user->appointments()->where('status', 'confirmed')->count();

        // 2. Forum Activity
        $totalThreads = $user->threads()->count();
        $latestThreads = $user->threads()->latest()->take(3)->get(); // Get the last 3 threads

        // Pass all statistics to the dashboard view
        return view('dashboard', compact(
            'pendingAppointments', 
            'confirmedAppointments', 
            'totalThreads', 
            'latestThreads'
        ));
    }
}
