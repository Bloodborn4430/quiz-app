<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizes = Quiz::all();

        return view('quizes_list', ['quizes' => $quizes]);
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        return view('quiz_show', [
            'quiz_title' => $quiz->title,
            'questions' => $quiz->questions->pluck('question_text'),
            'quiz_id' => $quiz->id,
        ]);
    }

    public function answer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|min:2',
        ]);

        return view('answer_result', [
            'answer' => $request->answer,
            'quiz_id' => $id,
        ]);
    }
}
