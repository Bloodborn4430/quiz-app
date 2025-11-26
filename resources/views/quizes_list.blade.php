<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz List</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
    </style>
</head>
<body>
    <h1>Available Quizes</h1>
    <p>Choose one</p>

    <ol>
    @foreach($quizes as $quiz)
    <li><a href="{{ url('quizes/' . $quiz['id']) }}">{{ $quiz['title'] }}</a></li>
    @endforeach

</ol>

    <a href="/">Back to main page</a>
</body>
</html>
