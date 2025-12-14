<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon; // Needed for date filtering

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. DOCTOR DASHBOARD LOGIC
        if ($user->isDoctor()) {
            
            // Get Counts for Stats Cards
            $totalPending = Appointment::where('status', 'pending')->count();
            $totalConfirmed = Appointment::where('status', 'confirmed')->count();
            
            // Count sessions specifically for TODAY that are confirmed
            $todayAppointments = Appointment::whereDate('scheduled_at', Carbon::today())->where('status', 'confirmed')->count();

            // Get the 5 most recent requests for the "Quick View" table
            $recentAppointments = Appointment::with('user')->orderBy('created_at', 'desc')->take(5)->get();

            // Return the view with Doctor data
            return view('dashboard', compact(
                'totalPending', 
                'totalConfirmed', 
                'todayAppointments', 
                'recentAppointments'
            ));
        } 
        
        // 2. STUDENT DASHBOARD LOGIC
        else {
            
            // Personal appointment stats
            $pendingAppointments = $user->appointments()->where('status', 'pending')->count();
            $confirmedAppointments = $user->appointments()->where('status', 'confirmed')->count();
            
            // Personal forum stats
            $totalThreads = $user->threads()->count();
            $latestThreads = $user->threads()->latest()->take(3)->get();
            
            // Return the view with Student data
            return view('dashboard', compact(
                'pendingAppointments', 
                'confirmedAppointments', 
                'totalThreads', 
                'latestThreads'
            ));
        }
    }
}