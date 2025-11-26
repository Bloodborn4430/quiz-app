<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{

    public function index(Request $request)
    {
        $query = Question::with('quiz');

        // Filter by quiz if specified
        if ($request->has('quiz_id') && $request->quiz_id) {
            $query->where('quiz_id', $request->quiz_id);
        }

        $questions = $query->orderBy('created_at', 'desc')->paginate(15);
        $quizzes = Quiz::all();

        return view('admin.questions.index', compact('questions', 'quizzes'));
    }


    public function create(Request $request)
    {
        $quizzes = Quiz::all();
        $selectedQuizId = $request->get('quiz_id');

        return view('admin.questions.create', compact('quizzes', 'selectedQuizId'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string|min:5|max:1000',
            'answers' => 'required|array|min:2|max:6',
            'answers.*' => 'required|string|min:1|max:500',
            'correct_answer' => 'required|integer|min:0|max:' . (count($request->answers ?? []) - 1),
        ]);

        $question = Question::create([
            'quiz_id' => $request->quiz_id,
            'question_text' => $request->question_text,
        ]);

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question created successfully');
    }


    public function show(Question $question)
    {
        $question->load('quiz', 'answers');
        return view('admin.questions.show', compact('question'));
    }


    public function edit(Question $question)
    {
        $quizzes = Quiz::all();
        $question->load('answers');
        return view('admin.questions.edit', compact('question', 'quizzes'));
    }


    public function update(Request $request, Question $question)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string|min:5|max:1000',
            'answers' => 'required|array|min:2|max:6',
            'answers.*' => 'required|string|min:1|max:500',
            'correct_answer' => 'required|integer|min:0|max:' . (count($request->answers ?? []) - 1),
        ]);

        $question->update([
            'quiz_id' => $request->quiz_id,
            'question_text' => $request->question_text,
        ]);


        $question->answers()->delete();

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question updated successfully');
    }


    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question deleted successfully');
    }
}
