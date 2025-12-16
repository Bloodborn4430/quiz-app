<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();

        return view('quizes_list', ['quizzes' => $quizzes]);
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);

        return view('quiz_show', [
            'quiz' => $quiz,
        ]);
    }

    public function answer(Request $request, $id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        
        // Validate that quiz has questions
        if ($quiz->questions->isEmpty()) {
            return redirect()->route('quiz.show', $quiz->id)
                ->with('error', 'This quiz has no questions.');
        }

        // Prepare validation rules dynamically based on quiz questions
        $rules = [
            'answers' => 'required|array|size:' . $quiz->questions->count(),
        ];
        
        $validAnswerIds = [];
        foreach ($quiz->questions as $index => $question) {
            $questionAnswerIds = $question->answers->pluck('id')->toArray();
            $validAnswerIds = array_merge($validAnswerIds, $questionAnswerIds);
            
            $rules['answers.' . $index] = [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($question, $questionAnswerIds) {
                    if (!in_array($value, $questionAnswerIds)) {
                        $fail('The selected answer for question ' . ($question->id) . ' is invalid.');
                    }
                },
            ];
        }

        $request->validate($rules, [
            'answers.required' => 'Please answer all questions.',
            'answers.size' => 'You must answer all ' . $quiz->questions->count() . ' questions.',
            'answers.*.required' => 'Please select an answer for all questions.',
            'answers.*.integer' => 'Invalid answer format.',
        ]);

        $userAnswers = $request->answers;
        $results = [];

        foreach ($quiz->questions as $index => $question) {
            $userAnswerId = $userAnswers[$index] ?? null;
            $correctAnswer = $question->answers->where('is_correct', true)->first();

            $results[] = [
                'question' => $question,
                'user_answer_id' => $userAnswerId,
                'user_answer' => $userAnswerId ? $question->answers->find($userAnswerId) : null,
                'correct_answer' => $correctAnswer,
                'is_correct' => $userAnswerId && $correctAnswer && $userAnswerId == $correctAnswer->id,
            ];
        }

        $correctCount = collect($results)->where('is_correct', true)->count();
        $totalQuestions = $quiz->questions->count();
        $percentage = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0;

        return view('answer_result', [
            'quiz' => $quiz,
            'results' => $results,
            'correct_count' => $correctCount,
            'total_questions' => $totalQuestions,
            'percentage' => $percentage,
        ]);
    }
}
