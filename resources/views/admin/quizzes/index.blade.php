@extends('layouts.app')

@section('title', 'Quizzes Management')

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

    .quizzes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .quiz-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
    }

    .quiz-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .quiz-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
        display: block;
    }

    .quiz-description {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .quiz-actions {
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

    .no-quizzes {
        text-align: center;
        padding: 3rem;
        color: #666;
        font-size: 1.1rem;
    }

    .no-quizzes a {
        color: #667eea;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
@if(session('success'))
<div style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
    {{ session('success') }}
</div>
@endif

<div class="admin-header">
    <h1>Quizzes Management</h1>
    <a href="{{ route('admin.quizzes.create') }}" class="add-btn">➕ Add Quiz</a>
</div>

@if($quizzes->count() > 0)
<div class="quizzes-grid">
    @foreach($quizzes as $quiz)
    <div class="quiz-card">
        <a href="{{ route('admin.quizzes.show', $quiz->id) }}" class="quiz-title">
            {{ $quiz->title }}
        </a>

        @if($quiz->description)
        <div class="quiz-description">
            {{ Str::limit($quiz->description, 150) }}
        </div>
        @endif

        <div class="quiz-actions">
            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="btn btn-edit">✏️ Edit</a>
            <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete"
                    onclick="return confirm('Are you sure you want to delete the quiz «{{ $quiz->title }}»?')">
                    🗑️ Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="no-quizzes">
    <p>There is no quiz yet.</p>
    <p><a href="{{ route('admin.quizzes.create') }}">Create your first quiz</a></p>
</div>
@endif
@endsection