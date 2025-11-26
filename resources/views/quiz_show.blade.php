@extends('layouts.app')

@section('title', 'Quiz: ' . $quiz->title)

@push('styles')
<style>
    .quiz-container {
        max-width: 800px;
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
        text-align: center;
        margin-bottom: 2rem;
        color: #666;
    }

    .questions-container {
        margin-bottom: 2rem;
    }

    .question-item {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid #e1e5e9;
    }

    .question-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .question-text {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .answers-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .answer-option {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        background: white;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .answer-option:hover {
        border-color: #667eea;
        box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
    }

    .answer-option input[type="radio"] {
        margin-right: 1rem;
        transform: scale(1.2);
    }

    .answer-text {
        flex: 1;
        color: #333;
        font-size: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid #e1e5e9;
    }

    .btn {
        padding: 0.875rem 2rem;
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

    .progress-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="quiz-container">
    <div class="quiz-header">
        <h1>{{ $quiz->title }}</h1>
    </div>

    @if($quiz->description)
    <div class="quiz-description">
        <p>{{ $quiz->description }}</p>
    </div>
    @endif

    <div class="progress-info">
        📝 Answer all questions | {{ $quiz->questions->count() }} question{{ $quiz->questions->count() !== 1 ? 's' : '' }} total
    </div>

    @if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('quiz.answer', $quiz->id) }}" method="POST" id="quiz-form">
        @csrf

        <div class="questions-container">
            @foreach($quiz->questions as $index => $question)
            <div class="question-item">
                <div class="question-number">
                    Question {{ $index + 1 }} of {{ $quiz->questions->count() }}
                </div>
                <div class="question-text">
                    {{ $question->question_text }}
                </div>
                <div class="answers-list">
                    @foreach($question->answers as $answerIndex => $answer)
                    <label class="answer-option">
                        <input type="radio"
                            name="answers[{{ $index }}]"
                            value="{{ $answer->id }}"
                            required>
                        <span class="answer-text">{{ $answer->answer_text }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="form-actions">
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">
                ← Back to quizzes
            </a>
            <button type="submit" class="btn btn-primary">
                Submit Answers 📤
            </button>
        </div>
    </form>

    <a href="{{ route('quizzes.index') }}" class="back-link">← Back to quiz list</a>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('quiz-form');

        form.addEventListener('submit', function(e) {
            const questions = form.querySelectorAll('.question-item');
            let allAnswered = true;

            questions.forEach(question => {
                const radios = question.querySelectorAll('input[type="radio"]');
                const checked = Array.from(radios).some(radio => radio.checked);

                if (!checked) {
                    allAnswered = false;
                    question.style.borderLeft = '4px solid #dc3545';
                } else {
                    question.style.borderLeft = '4px solid #28a745';
                }
            });

            if (!allAnswered) {
                e.preventDefault();
                alert('Please answer all questions before submitting.');
                return false;
            }

            return confirm('Are you sure you want to submit your answers? You won\'t be able to change them.');
        });
    });
</script>
@endpush