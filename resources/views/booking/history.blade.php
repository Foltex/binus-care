@extends('layouts.app')

@section('content')
<h2 class="mb-4">📋 My Appointment History</h2>
<div class="table-responsive bg-white p-3 rounded shadow-sm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Status</th>
                <th>Notes</th>
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
                        @if($apt->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($apt->status == 'confirmed')
                            <span class="badge bg-primary">Confirmed</span>
                        @else
                            <span class="badge bg-secondary">Completed</span>
                        @endif
                    </td>
                    <td>{{ $apt->notes ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No appointment history found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection