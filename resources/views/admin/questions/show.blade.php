@extends('layouts.app')

@section('title', 'View Question')

@push('styles')
<style>
  .question-detail-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .question-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e1e5e9;
  }

  .question-header h1 {
    color: #333;
    font-size: 2rem;
    margin: 0;
  }

  .quiz-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    text-align: center;
  }

  .quiz-info h2 {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
  }

  .quiz-info p {
    margin: 0;
    opacity: 0.9;
  }

  .question-content {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 12px;
    border-left: 4px solid #667eea;
    margin-bottom: 2rem;
  }

  .question-text {
    font-size: 1.25rem;
    line-height: 1.6;
    color: #333;
    margin: 0;
    white-space: pre-wrap;
  }

  .question-meta {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
  }

  .meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
  }

  .meta-item {
    text-align: center;
  }

  .meta-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .meta-value {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
  }

  .actions-section {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .actions-header {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
  }

  .actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
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
    text-align: center;
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

  .btn-danger {
    background: #dc3545;
    color: white;
  }

  .btn-danger:hover {
    background: #c82333;
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

  .answers-section h3 {
    margin-bottom: 1rem;
    color: #333;
  }

  .answers-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .answer-item {
    padding: 1rem;
    border-radius: 8px;
    border: 2px solid;
  }

  .answer-item.correct {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-color: #28a745;
  }

  .answer-item.incorrect {
    background: #f8f9fa;
    border-color: #e1e5e9;
  }

  .answer-indicator {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  .answer-item.correct .answer-indicator {
    color: #155724;
  }

  .answer-item.incorrect .answer-indicator {
    color: #6c757d;
  }

  .answer-text {
    color: #333;
    line-height: 1.4;
  }
</style>
@endpush

@section('content')
<div class="question-detail-container">
  <div class="question-header">
    <h1>Question Details</h1>
  </div>

  <div class="quiz-info">
    <h2>📚 {{ $question->quiz->title }}</h2>
    @if($question->quiz->description)
    <p>{{ $question->quiz->description }}</p>
    @endif
  </div>

  <div class="question-content">
    <p class="question-text">{{ $question->question_text }}</p>
  </div>

  <div class="answers-section">
    <h3>Answer Options</h3>
    <div class="answers-list">
      @foreach($question->answers as $answer)
      <div class="answer-item {{ $answer->is_correct ? 'correct' : 'incorrect' }}">
        <div class="answer-indicator">
          @if($answer->is_correct)
          ✅ Correct Answer
          @else
          ❌ Incorrect Answer
          @endif
        </div>
        <div class="answer-text">
          {{ $answer->answer_text }}
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="question-meta">
    <div class="meta-grid">
      <div class="meta-item">
        <div class="meta-label">Created</div>
        <div class="meta-value">{{ $question->created_at->format('M j, Y') }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Last Updated</div>
        <div class="meta-value">{{ $question->updated_at->format('M j, Y') }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Question ID</div>
        <div class="meta-value">#{{ $question->id }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Quiz ID</div>
        <div class="meta-value">#{{ $question->quiz_id }}</div>
      </div>
    </div>
  </div>

  <div class="actions-section">
    <div class="actions-header">Actions</div>
    <div class="actions-grid">
      <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-primary">✏️ Edit Question</a>
      <a href="{{ route('admin.questions.create', ['quiz_id' => $question->quiz_id]) }}" class="btn btn-secondary">➕ Add Similar</a>
      <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
          onclick="return confirm('Are you sure you want to delete this question? This action cannot be undone.')">
          🗑️ Delete Question
        </button>
      </form>
    </div>
  </div>

  <a href="{{ route('admin.questions.index') }}" class="back-link">← Back to questions list</a>
</div>
@endsection