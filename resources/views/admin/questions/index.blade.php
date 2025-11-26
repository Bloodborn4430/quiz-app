@extends('layouts.app')

@section('title', 'Questions Management')

@push('styles')
<style>
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e1e5e9;
    }

    .admin-header h1 {
        color: #333;
        font-size: 2.5rem;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .add-btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .filter-form {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 1rem;
        background: white;
    }

    .btn-filter {
        padding: 0.75rem 1.5rem;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-filter:hover {
        background: #5a6268;
    }

    .questions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 1.5rem;
    }

    .question-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
    }

    .question-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .question-quiz {
        font-size: 0.9rem;
        color: #667eea;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .question-text {
        color: #333;
        font-size: 1.1rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: block;
    }

    .question-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-align: center;
    }

    .btn-view {
        background: #17a2b8;
        color: white;
    }

    .btn-view:hover {
        background: #138496;
        transform: translateY(-1px);
    }

    .btn-edit {
        background: #28a745;
        color: white;
    }

    .btn-edit:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .no-questions {
        text-align: center;
        padding: 3rem;
        color: #666;
        font-size: 1.1rem;
    }

    .no-questions a {
        color: #667eea;
        font-weight: 600;
    }

    .pagination-container {
        margin-top: 2rem;
        text-align: center;
    }

    .pagination {
        display: inline-flex;
        gap: 0.5rem;
    }

    .pagination a,
    .pagination span {
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid #dee2e6;
        color: #007bff;
        background: white;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: #007bff;
        color: white;
    }

    .pagination .active span {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>
@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="admin-header">
    <h1>Questions Management</h1>
    <div class="header-actions">
        <a href="{{ route('admin.questions.create') }}" class="add-btn">➕ Add Question</a>
        <a href="{{ route('admin.quizzes.index') }}" class="add-btn" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">📚 Back to Quizzes</a>
    </div>
</div>

<div class="filter-section">
    <form method="GET" class="filter-form">
        <div class="form-group">
            <label for="quiz_id">Filter by Quiz:</label>
            <select name="quiz_id" id="quiz_id">
                <option value="">All Quizzes</option>
                @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}" {{ request('quiz_id') == $quiz->id ? 'selected' : '' }}>
                    {{ $quiz->title }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-filter">🔍 Filter</button>
        @if(request('quiz_id'))
        <a href="{{ route('admin.questions.index') }}" class="btn-filter" style="background: #dc3545;">❌ Clear Filter</a>
        @endif
    </form>
</div>

@if($questions->count() > 0)
<div class="questions-grid">
    @foreach($questions as $question)
    <div class="question-card">
        <div class="question-quiz">
            📚 {{ $question->quiz->title }}
        </div>
        <a href="{{ route('admin.questions.show', $question->id) }}" class="question-text">
            {{ Str::limit($question->question_text, 150) }}
        </a>
        <div class="question-actions">
            <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-view">👁️ View</a>
            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-edit">✏️ Edit</a>
            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete"
                    onclick="return confirm('Are you sure you want to delete this question?')">
                    🗑️ Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-container">
    {{ $questions->appends(request()->query())->links() }}
</div>
@else
<div class="no-questions">
    <p>No questions found.</p>
    @if(request('quiz_id'))
    <p>Try <a href="{{ route('admin.questions.index') }}">clearing the filter</a> or <a href="{{ route('admin.questions.create') }}">create a new question</a>.</p>
    @else
    <p><a href="{{ route('admin.questions.create') }}">Create the first question</a></p>
    @endif
</div>
@endif
@endsection