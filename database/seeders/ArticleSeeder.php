<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            ['title' => '5 Tips Menghindari Burnout saat Ujian', 'category' => 'Mental Health'],
            ['title' => 'Nutrisi Cepat Saji yang Sehat di Kampus', 'category' => 'Nutrition'],
            ['title' => 'Pentingnya Tidur 8 Jam untuk Konsentrasi', 'category' => 'Sleep'],
            ['title' => 'Cara Mengelola Stress dengan Teknik Pernapasan', 'category' => 'Mental Health'],
            ['title' => 'Vaksin Booster dan Aturan Kampus Terbaru', 'category' => 'Medical'],
        ];

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'category' => $data['category'],
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
                'image_path' => 'default.jpg'
            ]);
        }
    }
}
