<h1>Quizzes</h1>
<a href="{{ route('quizzes.create') }}">Add Quiz</a>

<ul>
    @foreach($quizzes as $quiz)
        <li>
            {{ $quiz->title }}
            <a href="{{ route('quizzes.edit', $quiz->id) }}">Edit</a>
            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
