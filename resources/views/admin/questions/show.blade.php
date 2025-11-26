<h1>Question</h1>
<p>{{ $question->question_text }}</p>

<a href="{{ route('questions.index', $question->quiz->id) }}">Back</a>
