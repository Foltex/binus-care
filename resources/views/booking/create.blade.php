@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-primary text-white fw-bold text-center py-3 rounded-top-4">
                book a Consultation
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('booking.store') }}" method="POST" onsubmit="return confirm('Are you sure you want to book this session?');">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small">TYPE OF SERVICE</label>
                        <select name="type" class="form-select form-select-lg bg-light border-0" required>
                            <option value="psychology">Psychology Counseling</option>
                            <option value="medical">Medical Check-up</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small">PREFERRED DATE & TIME</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-event"></i></span>
                            
                            <input type="text" 
                                   id="datetimepicker"
                                   name="scheduled_at" 
                                   class="form-control form-control-lg bg-light border-0 @error('scheduled_at') is-invalid @enderror" 
                                   placeholder="Select Date and Time..."
                                   required>
                        </div>
                        @error('scheduled_at')
                            <div class="text-danger small mt-1">
                                Please select a future date and time.
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small">NOTES / SYMPTOMS</label>
                        <textarea name="notes" class="form-control bg-light border-0" rows="3" placeholder="Briefly describe what you are feeling..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm fw-bold">
                        Submit Booking Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datetimepicker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",       
        time_24hr: true,        
        disableMobile: "true",  
        theme: "material_blue"
    });
</script>

@endsection