<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        Question::create(['quiz_id' => 1, 'question_text' => 'What does HTML stand for?']);
        Question::create(['quiz_id' => 1, 'question_text' => 'What is a heading tag in HTML?']);

        Question::create(['quiz_id' => 2, 'question_text' => 'What is PHP?']);
        Question::create(['quiz_id' => 2, 'question_text' => 'How to declare a variable in PHP?']);

        Question::create(['quiz_id' => 3, 'question_text' => 'What is Laravel?']);
        Question::create(['quiz_id' => 3, 'question_text' => 'What is a route in Laravel?']);

        Question::create(['quiz_id' => 4, 'question_text' => 'What does CSS stand for?']);
        Question::create(['quiz_id' => 4, 'question_text' => 'How to change text color in CSS?']);
    }
}
