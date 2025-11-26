@extends('layouts.app')

@section('title', 'Main page')

@section('content')
<div style="text-align: center; padding: 4rem 2rem;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem; color: #333;">Welcome to Quiz App!</h1>
    <p style="font-size: 1.2rem; margin-bottom: 2rem; color: #666;">Try our exciting quizzes!</p>

    <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ url('/quizes') }}" style="
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        ">Quizzes list</a>

        @auth
        @if(Auth::user()->is_admin)
        <a href="{{ url('/admin/quizzes') }}" style="
                    display: inline-block;
                    padding: 1rem 2rem;
                    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    font-size: 1.2rem;
                    font-weight: bold;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                    transition: transform 0.3s ease;
                ">Admin panel</a>
        @endif
        @endauth
    </div>
</div>
@endsection