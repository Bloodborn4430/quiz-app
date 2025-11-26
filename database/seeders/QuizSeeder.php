<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Quiz 1: HTML Basics
        $quiz1 = Quiz::create([
            'title' => 'HTML Basics',
            'description' => 'Test your knowledge of fundamental HTML concepts and tags.'
        ]);

        // HTML Questions
        $q1 = Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'What does HTML stand for?'
        ]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'HyperText Markup Language', 'is_correct' => true]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'High Tech Modern Language', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Home Tool Management Link', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Hyperlink and Text Markup Language', 'is_correct' => false]);

        $q2 = Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'Which tag is used to create a hyperlink in HTML?'
        ]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => '<a>', 'is_correct' => true]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => '<link>', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => '<href>', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => '<url>', 'is_correct' => false]);

        $q3 = Question::create([
            'quiz_id' => $quiz1->id,
            'question_text' => 'What is the correct HTML element for the largest heading?'
        ]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => '<h1>', 'is_correct' => true]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => '<h6>', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => '<heading>', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => '<head>', 'is_correct' => false]);

        // Quiz 2: PHP for Beginners
        $quiz2 = Quiz::create([
            'title' => 'PHP for Beginners',
            'description' => 'Basic PHP concepts and syntax for newcomers to programming.'
        ]);

        // PHP Questions
        $q4 = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'What does PHP stand for?'
        ]);
        Answer::create(['question_id' => $q4->id, 'answer_text' => 'PHP: Hypertext Preprocessor', 'is_correct' => true]);
        Answer::create(['question_id' => $q4->id, 'answer_text' => 'Personal Home Page', 'is_correct' => false]);
        Answer::create(['question_id' => $q4->id, 'answer_text' => 'Private Home Page', 'is_correct' => false]);
        Answer::create(['question_id' => $q4->id, 'answer_text' => 'PHP: Hypertext Processor', 'is_correct' => false]);

        $q5 = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Which symbol is used to start a PHP code block?'
        ]);
        Answer::create(['question_id' => $q5->id, 'answer_text' => '<?php', 'is_correct' => true]);
        Answer::create(['question_id' => $q5->id, 'answer_text' => '<php>', 'is_correct' => false]);
        Answer::create(['question_id' => $q5->id, 'answer_text' => '<?', 'is_correct' => false]);
        Answer::create(['question_id' => $q5->id, 'answer_text' => '<script>', 'is_correct' => false]);

        $q6 = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'How do you declare a variable in PHP?'
        ]);
        Answer::create(['question_id' => $q6->id, 'answer_text' => '$variable_name = value;', 'is_correct' => true]);
        Answer::create(['question_id' => $q6->id, 'answer_text' => 'variable variable_name = value;', 'is_correct' => false]);
        Answer::create(['question_id' => $q6->id, 'answer_text' => 'var variable_name = value;', 'is_correct' => false]);
        Answer::create(['question_id' => $q6->id, 'answer_text' => 'declare variable_name = value;', 'is_correct' => false]);

        // Quiz 3: Introduction to Laravel
        $quiz3 = Quiz::create([
            'title' => 'Introduction to Laravel',
            'description' => 'Learn about the Laravel PHP framework and its key concepts.'
        ]);

        // Laravel Questions
        $q7 = Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'What is Laravel?'
        ]);
        Answer::create(['question_id' => $q7->id, 'answer_text' => 'A PHP web framework', 'is_correct' => true]);
        Answer::create(['question_id' => $q7->id, 'answer_text' => 'A JavaScript library', 'is_correct' => false]);
        Answer::create(['question_id' => $q7->id, 'answer_text' => 'A database management system', 'is_correct' => false]);
        Answer::create(['question_id' => $q7->id, 'answer_text' => 'A CSS framework', 'is_correct' => false]);

        $q8 = Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'Which command is used to create a new Laravel project?'
        ]);
        Answer::create(['question_id' => $q8->id, 'answer_text' => 'composer create-project laravel/laravel project-name', 'is_correct' => true]);
        Answer::create(['question_id' => $q8->id, 'answer_text' => 'php artisan new project-name', 'is_correct' => false]);
        Answer::create(['question_id' => $q8->id, 'answer_text' => 'laravel create project-name', 'is_correct' => false]);
        Answer::create(['question_id' => $q8->id, 'answer_text' => 'npm create laravel project-name', 'is_correct' => false]);

        $q9 = Question::create([
            'quiz_id' => $quiz3->id,
            'question_text' => 'What is the purpose of Laravel\'s Eloquent ORM?'
        ]);
        Answer::create(['question_id' => $q9->id, 'answer_text' => 'To interact with databases using object-oriented syntax', 'is_correct' => true]);
        Answer::create(['question_id' => $q9->id, 'answer_text' => 'To create CSS stylesheets', 'is_correct' => false]);
        Answer::create(['question_id' => $q9->id, 'answer_text' => 'To handle HTTP requests', 'is_correct' => false]);
        Answer::create(['question_id' => $q9->id, 'answer_text' => 'To manage file uploads', 'is_correct' => false]);

        // Quiz 4: CSS & Styling
        $quiz4 = Quiz::create([
            'title' => 'CSS & Styling',
            'description' => 'Master CSS fundamentals and modern styling techniques.'
        ]);

        // CSS Questions
        $q10 = Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'What does CSS stand for?'
        ]);
        Answer::create(['question_id' => $q10->id, 'answer_text' => 'Cascading Style Sheets', 'is_correct' => true]);
        Answer::create(['question_id' => $q10->id, 'answer_text' => 'Computer Style Sheets', 'is_correct' => false]);
        Answer::create(['question_id' => $q10->id, 'answer_text' => 'Creative Style Sheets', 'is_correct' => false]);
        Answer::create(['question_id' => $q10->id, 'answer_text' => 'Cascading Simple Sheets', 'is_correct' => false]);

        $q11 = Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'How do you change the text color in CSS?'
        ]);
        Answer::create(['question_id' => $q11->id, 'answer_text' => 'color: red;', 'is_correct' => true]);
        Answer::create(['question_id' => $q11->id, 'answer_text' => 'text-color: red;', 'is_correct' => false]);
        Answer::create(['question_id' => $q11->id, 'answer_text' => 'font-color: red;', 'is_correct' => false]);
        Answer::create(['question_id' => $q11->id, 'answer_text' => 'text: red;', 'is_correct' => false]);

        $q12 = Question::create([
            'quiz_id' => $quiz4->id,
            'question_text' => 'Which CSS property is used to control the spacing between elements?'
        ]);
        Answer::create(['question_id' => $q12->id, 'answer_text' => 'margin', 'is_correct' => true]);
        Answer::create(['question_id' => $q12->id, 'answer_text' => 'padding', 'is_correct' => false]);
        Answer::create(['question_id' => $q12->id, 'answer_text' => 'spacing', 'is_correct' => false]);
        Answer::create(['question_id' => $q12->id, 'answer_text' => 'border', 'is_correct' => false]);
    }
}
