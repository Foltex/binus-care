<?php

namespace Database\Seeders;

use App\Models\ForumThread;
use App\Models\ForumReply;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentIds = User::where('role', User::ROLE_STUDENT)->pluck('id');
        $testStudentId = User::where('email', 'student@binus.ac.id')->value('id');

        $thread1 = ForumThread::create([
            'user_id' => $testStudentId,
            'title' => 'Sulit Fokus di Kelas Online, Ada Tips?',
            'body' => 'Sejak kuliah hybrid, saya sering hilang fokus. Adakah Binusian lain yang merasakan hal sama? Bagikan tips kalian dong!',
        ]);

        $thread2 = ForumThread::create([
            'user_id' => $studentIds->random(),
            'title' => 'Rekomendasi Makanan Sehat Murah di Kantin',
            'body' => 'Lagi diet tapi kantong menipis. Ada rekomendasi warung atau menu sehat yang harganya bersahabat di sekitar kampus?',
        ]);

        // replies
        ForumReply::create(['user_id' => $studentIds->random(), 'forum_thread_id' => $thread1->id, 'body' => 'Coba teknik Pomodoro, sangat membantu!']);
        ForumReply::create(['user_id' => $studentIds->random(), 'forum_thread_id' => $thread1->id, 'body' => 'Saya biasanya minum kopi sebelum kelas, tapi jangan terlalu banyak.']);
    }
}
