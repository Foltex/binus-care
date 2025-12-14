@extends('layouts.app')

@section('content')

    <!-- doctor -->
    @if (Auth::user()->isDoctor())
        
        <div class="container">
            <h2 class="mb-4 text-primary fw-bold">Doctor Dashboard</h2>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-warning bg-opacity-10 border-0 shadow-sm p-3 text-center">
                        <h5>Pending</h5>
                        <h2 class="fw-bold">{{ $totalPending ?? 0 }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary bg-opacity-10 border-0 shadow-sm p-3 text-center">
                        <h5>Confirmed</h5>
                        <h2 class="fw-bold">{{ $totalConfirmed ?? 0 }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success bg-opacity-10 border-0 shadow-sm p-3 text-center">
                        <h5>Today</h5>
                        <h2 class="fw-bold">{{ $todayAppointments ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <h4>Recent Requests</h4>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3">Patient</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAppointments ?? [] as $apt)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $apt->user->name }}</td>
                                    <td>{{ $apt->created_at->diffForHumans() }}</td>
                                    <td>
                                        {{-- COLORFUL STATUS BADGES --}}
                                        @if($apt->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($apt->status == 'confirmed')
                                            <span class="badge bg-primary">Confirmed</span>
                                        @elseif($apt->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($apt->status == 'canceled')
                                            <span class="badge bg-danger">Canceled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-light border">Manage</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center p-3 text-muted">No recent requests.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <!-- students -->
    @else

        <div class="container py-4">
            <h1 class="text-primary fw-bold">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-muted mb-4">Here is your health appointment status.</p>

            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow h-100 p-4">
                        <h6 class="text-muted fw-bold">WAITING CONFIRMATION</h6>
                        <h2 class="display-4 fw-bold text-warning">{{ $pendingAppointments ?? 0 }}</h2>
                        <a href="{{ route('booking.history') }}" class="text-decoration-none stretched-link">View Details &rarr;</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow h-100 p-4">
                        <h6 class="text-muted fw-bold">CONFIRMED SESSIONS</h6>
                        <h2 class="display-4 fw-bold text-primary">{{ $confirmedAppointments ?? 0 }}</h2> <a href="{{ route('booking.history') }}" class="text-decoration-none stretched-link">View Details &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="text-center bg-light p-4 rounded-3 border border-dashed">
                <h5>Need to see a doctor?</h5>
                <a href="{{ route('booking.index') }}" class="btn btn-primary mt-2 shadow-sm">+ Book New Appointment</a>
            </div>
        </div>

    @endif

@endsection