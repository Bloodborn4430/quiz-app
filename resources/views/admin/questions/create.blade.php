<h1>Add Question for: {{ $quiz->title }}</h1>

<form action="{{ route('questions.store', $quiz->id) }}" method="POST">
    @csrf
    <input type="text" name="question_text" placeholder="Question text">
    <button type="submit">Save</button>
</form>

<a href="{{ route('questions.index', $quiz->id) }}">Back</a>
