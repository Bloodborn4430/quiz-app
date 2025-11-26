<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    // все квизы
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    // форма добавления
    public function create()
    {
        return view('admin.quizzes.create');
    }

    // сохранить новый
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Quiz::create(['title' => $request->title]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz added');
    }

    // показать один
    public function show(Quiz $quiz)
    {
        return view('admin.quizzes.show', compact('quiz'));
    }

    // форма редактирования
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    // обновить
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $quiz->update(['title' => $request->title]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated');
    }

    // удалить
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted');
    }
}
