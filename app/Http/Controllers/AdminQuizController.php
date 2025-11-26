<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.quizzes.edit', $quiz->id)->with('success', 'Quiz updated successfully');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully');
    }
}
