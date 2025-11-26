<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $quiz_title }}</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        ol {
            text-align: left;
            margin-top: 20px;
        }

        a {
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .errors {
            color: red;
            margin-bottom: 15px;
        }

        form {
            margin-top: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            padding: 8px 12px;
            width: 250px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

    </style>

</head>
<body>

    <h1>{{ $quiz_title }}</h1>
    <p>Answer the following questions:</p>

    <ol>
        @foreach($questions as $question)
            <li>{{ $question }}</li>
        @endforeach
    </ol>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/quiz/{{ $quiz_id }}/answer" method="POST">
        @csrf
        <input type="text" name="answer" placeholder="Your answer">
        <button type="submit">Send</button>
    </form>

    <a href="{{ url('quizes') }}">Back to quiz list</a>
</body>
</html>
