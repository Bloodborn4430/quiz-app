@extends('layouts.app')

@section('title', 'Edit Quiz')

@push('styles')
<style>
    .edit-form-container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e1e5e9;
    }

    .form-header h1 {
        color: #333;
        font-size: 2rem;
        margin: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e1e5e9;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }

    .back-link {
        display: inline-block;
        margin-top: 2rem;
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .questions-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #e1e5e9;
    }

    .questions-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .questions-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .questions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .question-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
    }

    .question-card:hover {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .question-text {
        font-size: 1rem;
        color: #333;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .question-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.75rem;
    }

    .question-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-small {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 6px;
    }

    .no-questions {
        text-align: center;
        padding: 2rem;
        color: #666;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e1e5e9;
    }

    .no-questions a {
        color: #28a745;
        font-weight: 600;
    }

    .success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .errors {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .errors ul {
        margin: 0;
        padding-left: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="edit-form-container">
    <div class="form-header">
        <h1>Edit Quiz</h1>
        <p class="text-muted">Edit quiz data</p>
    </div>

    @if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Quiz title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $quiz->title) }}" placeholder="Enter quiz title" required>
        </div>

        <div class="form-group">
            <label for="description">Description (optional)</label>
            <textarea id="description" name="description" placeholder="Describe the quiz">{{ old('description', $quiz->description ?? '') }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <div class="questions-section">
        <div class="questions-header">
            <h3 class="questions-title">Questions in this Quiz</h3>
            <a href="{{ route('admin.questions.create', ['quiz_id' => $quiz->id]) }}" class="btn btn-primary">➕ Add Question</a>
        </div>

        @if($quiz->questions->count() > 0)
        <div class="questions-grid">
            @foreach($quiz->questions as $question)
            <div class="question-card">
                <div class="question-text">
                    {{ Str::limit($question->question_text, 100) }}
                </div>
                <div class="question-meta">
                    {{ $question->answers->count() }} answer{{ $question->answers->count() !== 1 ? 's' : '' }}
                </div>
                <div class="question-actions">
                    <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-secondary btn-small">👁️ View</a>
                    <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-primary btn-small">✏️ Edit</a>
                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-small"
                            onclick="return confirm('Are you sure you want to delete this question?')">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-questions">
            <p>This quiz has no questions yet.</p>
            <p><a href="{{ route('admin.questions.create', ['quiz_id' => $quiz->id]) }}">Add the first question</a></p>
        </div>
        @endif
    </div>

    <a href="{{ route('admin.quizzes.index') }}" class="back-link">← Back to quizzes list</a>
</div>
@endsection