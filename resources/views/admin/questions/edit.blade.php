<h1>Edit Question for: {{ $question->quiz->title }}</h1>

<form action="{{ route('questions.update', $question->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="question_text" value="{{ $question->question_text }}">
    <button type="submit">Update</button>
</form>

<a href="{{ route('questions.index', $question->quiz->id) }}">Back</a>
