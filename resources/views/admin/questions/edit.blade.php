@extends('layouts.app')

@section('title', 'Edit Question')

@push('styles')
<style>
    .edit-form-container {
        max-width: 700px;
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

    .form-header p {
        color: #666;
        margin: 0.5rem 0 0 0;
    }

    .current-quiz {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: center;
    }

    .current-quiz strong {
        font-size: 1.1rem;
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

    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
        font-family: inherit;
    }

    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
        line-height: 1.5;
    }

    .character-count {
        font-size: 0.85rem;
        color: #666;
        text-align: right;
        margin-top: 0.25rem;
    }

    .character-count.warning {
        color: #ffc107;
    }

    .character-count.danger {
        color: #dc3545;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: space-between;
        align-items: center;
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

    .success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .answer-option {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 6px;
        border: 1px solid #e1e5e9;
    }

    .answer-option input[type="radio"] {
        margin: 0;
    }

    .answer-option input[type="text"] {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.95rem;
    }

    .remove-answer {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 1.1rem;
        padding: 0.25rem;
        border-radius: 3px;
        transition: background 0.2s;
    }

    .remove-answer:hover {
        background: rgba(220, 53, 69, 0.1);
    }
</style>
@endpush

@section('content')
<div class="edit-form-container">
    <div class="form-header">
        <h1>Edit Question</h1>
        <p>Modify question details</p>
    </div>

    <div class="current-quiz">
        <strong>Current Quiz:</strong> {{ $question->quiz->title }}
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

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" id="question-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="quiz_id">Quiz *</label>
            <select name="quiz_id" id="quiz_id" required>
                @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}" {{ $question->quiz_id == $quiz->id ? 'selected' : '' }}>
                    {{ $quiz->title }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question_text">Question Text *</label>
            <textarea id="question_text" name="question_text" placeholder="Enter your question here..." required maxlength="1000">{{ old('question_text', $question->question_text) }}</textarea>
            <div class="character-count" id="char-count">{{ strlen($question->question_text) }} / 1000</div>
        </div>

        <div class="form-group">
            <label>Answer Options *</label>
            <div id="answers-container">
                @foreach($question->answers as $index => $answer)
                <div class="answer-option">
                    <input type="radio" name="correct_answer" value="{{ $index }}" {{ $answer->is_correct ? 'checked' : '' }} required>
                    <input type="text" name="answers[]" value="{{ old('answers.' . $index, $answer->answer_text) }}" placeholder="Enter answer option..." required maxlength="500">
                    <button type="button" class="remove-answer" {{ $question->answers->count() <= 2 ? 'style="display: none;"' : '' }}>❌</button>
                </div>
                @endforeach
            </div>
            <button type="button" id="add-answer" class="btn btn-secondary" style="margin-top: 0.5rem;">➕ Add Answer</button>
            <div style="font-size: 0.85rem; color: #666; margin-top: 0.25rem;">
                Select the radio button next to the correct answer
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-secondary">Cancel</a>
            <div>
                <button type="submit" class="btn btn-primary">Update Question</button>
            </div>
        </div>
    </form>

    <a href="{{ route('admin.questions.index') }}" class="back-link">← Back to questions list</a>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('question_text');
        const charCount = document.getElementById('char-count');
        const answersContainer = document.getElementById('answers-container');
        const addAnswerBtn = document.getElementById('add-answer');

        function updateCharCount() {
            const count = textarea.value.length;
            charCount.textContent = count + ' / 1000';

            charCount.classList.remove('warning', 'danger');
            if (count > 800) {
                charCount.classList.add('warning');
            }
            if (count > 950) {
                charCount.classList.add('danger');
            }
        }

        function addAnswer() {
            const answerCount = answersContainer.children.length;
            if (answerCount >= 6) return;

            const answerDiv = document.createElement('div');
            answerDiv.className = 'answer-option';
            answerDiv.innerHTML = `
            <input type="radio" name="correct_answer" value="${answerCount}" required>
            <input type="text" name="answers[]" placeholder="Enter answer option..." required maxlength="500">
            <button type="button" class="remove-answer">❌</button>
        `;

            answersContainer.appendChild(answerDiv);
            updateRemoveButtons();
        }

        function removeAnswer(button) {
            const answerCount = answersContainer.children.length;
            if (answerCount <= 2) return;

            button.closest('.answer-option').remove();
            updateCorrectAnswerValues();
            updateRemoveButtons();
        }

        function updateCorrectAnswerValues() {
            const radios = answersContainer.querySelectorAll('input[type="radio"]');
            const checkedValue = answersContainer.querySelector('input[type="radio"]:checked')?.value;

            radios.forEach((radio, index) => {
                radio.value = index;
            });

            // If there was a checked radio and its value is still valid, keep it checked
            if (checkedValue !== undefined && parseInt(checkedValue) < radios.length) {
                radios[parseInt(checkedValue)].checked = true;
            } else if (radios.length > 0) {
                // If the checked value is invalid, check the first radio
                radios[0].checked = true;
            }
        }

        function updateRemoveButtons() {
            const answers = answersContainer.children;
            const removeButtons = answersContainer.querySelectorAll('.remove-answer');

            removeButtons.forEach(button => {
                button.style.display = answers.length <= 2 ? 'none' : 'inline-block';
            });
        }

        // Event listeners
        textarea.addEventListener('input', updateCharCount);
        addAnswerBtn.addEventListener('click', addAnswer);

        answersContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-answer')) {
                removeAnswer(e.target);
            }
        });

        updateCharCount();
        updateRemoveButtons();
    });
</script>
@endpush