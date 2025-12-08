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

        if ($user->isDoctor()) {
            // DOCTOR: Fetch ALL appointments (Admin View Data)
            $allAppointments = Appointment::with('user')->orderBy('created_at', 'desc')->get();
            return view('dashboard', compact('allAppointments'));
        } else {
            // STUDENT: Fetch personal stats (Student View Data)
            $pendingAppointments = $user->appointments()->where('status', 'pending')->count();
            $confirmedAppointments = $user->appointments()->where('status', 'confirmed')->count();
            $totalThreads = $user->threads()->count();
            $latestThreads = $user->threads()->latest()->take(3)->get();
            
            return view('dashboard', compact(
                'pendingAppointments', 
                'confirmedAppointments', 
                'totalThreads', 
                'latestThreads'
            ));
        }
    }
}
