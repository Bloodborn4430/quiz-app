<h1>Edit Quiz</h1>

<form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $quiz->title }}">
    <button type="submit">Update</button>
</form>

<a href="{{ route('quizzes.index') }}">Back</a>
