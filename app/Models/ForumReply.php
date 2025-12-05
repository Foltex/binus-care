<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'forum_thread_id', 'body'];

    // A reply belongs to a specific Thread
    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'forum_thread_id');
    }

    // A reply belongs to a specific User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
