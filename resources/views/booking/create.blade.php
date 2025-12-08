@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">📅 Book a Consultation or Check-up</div>
            <div class="card-body">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Type of Service</label>
                        <select name="type" class="form-select" required>
                            <option value="psychology">🧠 Psychology Counseling</option>
                            <option value="medical">🩺 Medical Check-up</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preferred Date & Time</label>
                        <input type="datetime-local" name="scheduled_at" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes / Symptoms</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Briefly describe what you are feeling or the reason for your appointment..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit Booking Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection