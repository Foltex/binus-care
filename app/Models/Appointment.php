<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',          // 'medical' or 'psychology'
        'scheduled_at',  // DateTime of the booking
        'notes',         // User symptoms/notes
        'status'         // 'pending', 'confirmed', 'completed'
    ];

    // Ensure 'scheduled_at' is treated as a Carbon Date object, not just a string
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // An appointment belongs to one specific User (Student/Staff)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
