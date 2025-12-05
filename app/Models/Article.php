<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',         // URL friendly title (e.g., 'tips-for-exam-stress')
        'content',
        'category',     // e.g., 'Mental Health', 'Nutrition'
        'image_path'    // Path to the uploaded image file
    ];
}
