@extends('layouts.app')

@section('content')
<h2 class="mb-4 text-danger">Admin Panel: All Appointment Requests</h2>

<div class="table-responsive bg-white p-3 rounded shadow-sm">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Student</th>
                <th>Service Type</th>
                <th>Scheduled At</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($allAppointments as $apt)
                <tr>
                    <td>{{ $apt->user->name }}</td>
                    <td>
                        <span class="badge {{ $apt->type == 'psychology' ? 'bg-info' : 'bg-success' }}">
                            {{ ucfirst($apt->type) }}
                        </span>
                    </td>
                    <td>{{ $apt->scheduled_at->format('d M Y H:i') }}</td>
                    <td>{{ Str::limit($apt->notes, 40) ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $apt->status == 'pending' ? 'warning text-dark' : ($apt->status == 'confirmed' ? 'primary' : 'secondary') }}">
                            {{ ucfirst($apt->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($apt->status == 'pending' && Auth::user()->isDoctor())
                            <form action="{{ route('admin.appointments.confirm', $apt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to confirm this booking?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                            </form>
                        @elseif ($apt->status == 'confirmed')
                             <span class="text-success">Confirmed</span>
                        @else
                             —
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">No appointments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection