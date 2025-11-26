@extends('layouts.app')

@section('title', 'Login to the system')

@push('styles')
<style>
    .login-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        margin: 2rem auto;
    }

    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-header h2 {
        color: #333;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .login-header p {
        color: #666;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 0.875rem;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="email"]:focus,
    .form-group input[type="password"]:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .remember-me input[type="checkbox"] {
        margin-right: 0.75rem;
        width: 18px;
        height: 18px;
    }

    .login-btn {
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .error-message {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .error-message p {
        margin: 0;
    }

    .back-link {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e1e5e9;
    }

    .back-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .back-link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .admin-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        text-align: center;
        font-size: 0.9rem;
    }

    .admin-info strong {
        display: block;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-header">
        <h2>Login to the system</h2>
        <p>Login to your account to access quizzes</p>
    </div>

    <div class="admin-info">
        <strong>Test admin account:</strong><br>
        Email: admin@example.com<br>
        Password: password
    </div>

    @if($errors->any())
    <div class="error-message">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="your@email.com">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Your password">
        </div>

        <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="back-link">
        <a href="{{ url('/') }}">← Back to the main page</a>
    </div>
</div>
@endsection