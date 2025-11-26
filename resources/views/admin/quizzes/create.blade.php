create.blade.php<h1>Add Quiz</h1>

<form action="{{ route('quizzes.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Quiz title">
    <button type="submit">Save</button>
</form>

<a href="{{ route('quizzes.index') }}">Back</a>
