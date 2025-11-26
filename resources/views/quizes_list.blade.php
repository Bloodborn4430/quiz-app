@extends('layouts.app')

@section('title', 'Available Quizzes')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem 0;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 3rem; color: #333; margin-bottom: 1rem;">Available Quizzes</h1>
        <p style="font-size: 1.2rem; color: #666;">Choose a quiz to start testing your knowledge</p>
    </div>

    @if($quizzes->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
        @foreach($quizzes as $quiz)
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: 1px solid #e1e5e9; transition: transform 0.3s ease;">
            <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.5rem;">{{ $quiz->title }}</h3>

            @if($quiz->description)
            <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.5;">{{ Str::limit($quiz->description, 150) }}</p>
            @endif

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #666; font-size: 0.9rem;">
                    {{ $quiz->questions->count() }} question{{ $quiz->questions->count() !== 1 ? 's' : '' }}
                </span>
                <a href="{{ route('quiz.show', $quiz->id) }}"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                  color: white;
                                  text-decoration: none;
                                  padding: 0.75rem 1.5rem;
                                  border-radius: 8px;
                                  font-weight: 600;
                                  transition: all 0.3s ease;
                                  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                    Start Quiz
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align: center; padding: 3rem; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #666; margin-bottom: 1rem;">No quizzes available</h2>
        <p style="color: #999;">Check back later for new quizzes!</p>
    </div>
    @endif

    <div style="text-align: center; margin-top: 3rem;">
        <a href="{{ route('home') }}"
            style="color: #667eea; text-decoration: none; font-weight: 500; font-size: 1.1rem;">
            ← Back to main page
        </a>
    </div>
</div>
@endsection