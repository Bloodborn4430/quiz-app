<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::create(['title' => 'HTML Basics']);
        Quiz::create(['title' => 'PHP for Beginners']);
        Quiz::create(['title' => 'Introduction to Laravel']);
        Quiz::create(['title' => 'CSS & Styling']);
    }
}
