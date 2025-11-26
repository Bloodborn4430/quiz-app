@extends('layouts.app')

@section('title', 'Quiz Results - ' . $quiz->title)

@push('styles')
<style>
    .results-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .results-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e1e5e9;
    }

    .results-header h1 {
        color: #333;
        font-size: 2.5rem;
        margin: 0 0 0.5rem 0;
    }

    .score-summary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        text-align: center;
    }

    .score-summary h2 {
        margin: 0 0 1rem 0;
        font-size: 2rem;
    }

    .score-numbers {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .score-item {
        text-align: center;
    }

    .score-value {
        font-size: 2.5rem;
        font-weight: bold;
        display: block;
    }

    .score-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    .percentage {
        font-size: 1.5rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        display: inline-block;
        margin-top: 0.5rem;
    }

    .percentage.excellent {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .percentage.good {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
    }

    .percentage.needs-improvement {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
    }

    .question-results {
        margin-bottom: 2rem;
    }

    .question-result-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 2px solid;
        transition: all 0.3s ease;
    }

    .question-result-item.correct {
        border-color: #28a745;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 50%);
    }

    .question-result-item.incorrect {
        border-color: #dc3545;
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 50%);
    }

    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .question-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .question-status {
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .question-status.correct {
        background: #28a745;
        color: white;
    }

    .question-status.incorrect {
        background: #dc3545;
        color: white;
    }

    .question-text {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .answer-comparison {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .answer-section {
        padding: 1rem;
        border-radius: 8px;
    }

    .answer-section.your-answer {
        background: white;
        border: 2px solid #667eea;
    }

    .answer-section.correct-answer {
        background: linear-gradient(135deg, #28a745 0%, #20c997 50%);
        color: white;
    }

    .answer-label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .answer-text {
        font-size: 1rem;
        line-height: 1.4;
    }

    .actions-section {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
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

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
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

    @media (max-width: 768px) {
        .score-numbers {
            flex-direction: column;
            gap: 1rem;
        }

        .answer-comparison {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="results-container">
    <div class="results-header">
        <h1>Quiz Results</h1>
        <p>{{ $quiz->title }}</p>
    </div>

    <div class="score-summary">
        <h2>🎯 Your Performance</h2>
        <div class="score-numbers">
            <div class="score-item">
                <span class="score-value">{{ $correct_count }}</span>
                <span class="score-label">Correct Answers</span>
            </div>
            <div class="score-item">
                <span class="score-value">{{ $total_questions }}</span>
                <span class="score-label">Total Questions</span>
            </div>
            <div class="score-item">
                <span class="score-value">{{ $percentage }}%</span>
                <span class="score-label">Score</span>
            </div>
        </div>
        <div class="percentage {{ $percentage >= 80 ? 'excellent' : ($percentage >= 60 ? 'good' : 'needs-improvement') }}">
            @if($percentage >= 80)
            Excellent! 🎉
            @elseif($percentage >= 60)
            Good job! 👍
            @else
            Keep practicing! 📚
            @endif
        </div>
    </div>

    <div class="question-results">
        <h3 style="color: #333; margin-bottom: 1rem;">📋 Detailed Results</h3>

        @foreach($results as $index => $result)
        <div class="question-result-item {{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
            <div class="question-header">
                <span class="question-number">Question {{ $index + 1 }}</span>
                <span class="question-status {{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
                    {{ $result['is_correct'] ? '✅ Correct' : '❌ Incorrect' }}
                </span>
            </div>

            <div class="question-text">
                {{ $result['question']->question_text }}
            </div>

            <div class="answer-comparison">
                @if($result['user_answer'])
                <div class="answer-section your-answer">
                    <div class="answer-label">Your Answer</div>
                    <div class="answer-text">{{ $result['user_answer']->answer_text }}</div>
                </div>
                @else
                <div class="answer-section your-answer">
                    <div class="answer-label">Your Answer</div>
                    <div class="answer-text" style="font-style: italic; color: #666;">No answer provided</div>
                </div>
                @endif

                <div class="answer-section correct-answer">
                    <div class="answer-label">Correct Answer</div>
                    <div class="answer-text">{{ $result['correct_answer']->answer_text }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="actions-section">
        <div class="actions-header">What would you like to do next?</div>
        <div class="actions-grid">
            <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-success">
                🔄 Try Again
            </a>
            <a href="{{ route('quizzes.index') }}" class="btn btn-primary">
                📚 More Quizzes
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                🏠 Back to Home
            </a>
        </div>
    </div>

    <a href="{{ route('quizzes.index') }}" class="back-link">← Back to quiz list</a>
</div>
@endsection