@extends('layouts.app')

@section('title', 'Quiz: ' . $quiz->title)

@push('styles')
<style>
  .quiz-detail-container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .quiz-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e1e5e9;
  }

  .quiz-header h1 {
    color: #333;
    font-size: 2.5rem;
    margin: 0;
  }

  .quiz-description {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    text-align: center;
  }

  .quiz-description h2 {
    margin: 0 0 1rem 0;
    font-size: 1.8rem;
  }

  .quiz-description p {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
    line-height: 1.6;
  }

  .quiz-meta {
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
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
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

  .questions-section {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
  }

  .questions-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e1e5e9;
  }

  .questions-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .add-question-btn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .add-question-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
  }

  .questions-list {
    space-y: 1rem;
  }

  .question-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e1e5e9;
    transition: all 0.3s ease;
  }

  .question-item:hover {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
  }

  .question-text {
    flex: 1;
    font-size: 1rem;
    color: #333;
    margin-right: 1rem;
    line-height: 1.4;
  }

  .question-actions {
    display: flex;
    gap: 0.5rem;
  }

  .btn {
    padding: 0.4rem 0.8rem;
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
  }

  .btn-primary {
    background: #007bff;
    color: white;
  }

  .btn-primary:hover {
    background: #0056b3;
    transform: translateY(-1px);
  }

  .btn-secondary {
    background: #6c757d;
    color: white;
  }

  .btn-secondary:hover {
    background: #545b62;
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

  .no-questions {
    text-align: center;
    padding: 2rem;
    color: #666;
  }

  .no-questions a {
    color: #28a745;
    font-weight: 600;
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
</style>
@endpush

@section('content')
<div class="quiz-detail-container">
  <div class="quiz-header">
    <h1>{{ $quiz->title }}</h1>
  </div>

  @if($quiz->description)
  <div class="quiz-description">
    <h2>📚 Quiz Description</h2>
    <p>{{ $quiz->description }}</p>
  </div>
  @endif

  <div class="quiz-meta">
    <div class="meta-grid">
      <div class="meta-item">
        <div class="meta-label">Created</div>
        <div class="meta-value">{{ $quiz->created_at->format('M j, Y') }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Last Updated</div>
        <div class="meta-value">{{ $quiz->updated_at->format('M j, Y') }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Quiz ID</div>
        <div class="meta-value">#{{ $quiz->id }}</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Questions</div>
        <div class="meta-value">{{ $quiz->questions->count() }}</div>
      </div>
    </div>
  </div>

  <div class="questions-section">
    <div class="questions-header">
      <h3 class="questions-title">Questions in this Quiz</h3>
      <a href="{{ route('admin.questions.create', ['quiz_id' => $quiz->id]) }}" class="add-question-btn">
        ➕ Add Question
      </a>
    </div>

    @if($quiz->questions->count() > 0)
    <div class="questions-list">
      @foreach($quiz->questions as $question)
      <div class="question-item">
        <div class="question-text">
          {{ Str::limit($question->question_text, 100) }}
        </div>
        <div class="question-actions">
          <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-primary">👁️ View</a>
          <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-secondary">✏️ Edit</a>
          <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
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

  <div class="actions-section">
    <div class="actions-header">Quiz Actions</div>
    <div class="actions-grid">
      <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">✏️ Edit Quiz</a>
      <a href="{{ route('admin.questions.index', ['quiz_id' => $quiz->id]) }}" class="btn btn-secondary">📝 Manage Questions</a>
      <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
          onclick="return confirm('Are you sure you want to delete the quiz «{{ $quiz->title }}» and all its questions? This action cannot be undone.')">
          🗑️ Delete Quiz
        </button>
      </form>
    </div>
  </div>

  <a href="{{ route('admin.quizzes.index') }}" class="back-link">← Back to quizzes list</a>
</div>
@endsection