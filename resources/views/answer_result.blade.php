<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Result</title>

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

        .box {
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 350px;
            background: #f9f9f9;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 15px;
        }

        .answer {
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
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

    <div class="box">
        <h1>Answer Received!</h1>

        <p class="answer">Your answer: <strong>{{ $answer }}</strong></p>
        <p>Quiz ID: {{ $quiz_id }}</p>

        <br>

        <a href="{{ url('quizes') }}">Back to quiz list</a><br><br>
        <a href="{{ url('quizes/' . $quiz_id) }}">Try again</a>
    </div>

</body>
</html>
