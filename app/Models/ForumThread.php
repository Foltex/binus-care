<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'body'];

    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }
    
    // A Thread belongs to a User (the creator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
