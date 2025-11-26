<h1>Questions for: {{ $quiz->title }}</h1>
<a href="{{ route('questions.create', $quiz->id) }}">Add Question</a>

<ul>
    @foreach($quiz->questions as $question)
        <li>
            {{ $question->question_text }}
            <a href="{{ route('questions.edit', $question->id) }}">Edit</a>
            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

<a href="{{ route('quizzes.index') }}">Back to Quizzes</a>
