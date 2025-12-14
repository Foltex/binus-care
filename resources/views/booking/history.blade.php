@extends('layouts.app')

@section('content')
<h2 class="mb-4">My Appointment History</h2>
<div class="table-responsive bg-white p-3 rounded shadow-sm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->scheduled_at->format('d M Y, H:i') }}</td>
                    <td>
                        <span class="badge {{ $apt->type == 'psychology' ? 'bg-info' : 'bg-success' }}">
                            {{ ucfirst($apt->type) }}
                        </span>
                    </td>
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
                    <td>{{ $apt->notes ?? '-' }}</td>
                    
                    <td>
                        @if ($apt->status == 'pending')
                            <form action="{{ route('booking.cancel', $apt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Cancel Request</button>
                            </form>
                        @elseif ($apt->status == 'confirmed')
                            <span class="text-muted small">Contact Clinic</span>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No appointment history found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection