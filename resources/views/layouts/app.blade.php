<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz App') }} - @yield('title', 'Main page')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .header-center {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .current-date {
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 500;
        }

        .auth-links {
            display: flex;
            gap: 1rem;
        }

        .auth-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .auth-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .auth-link.login {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .logout-btn {
            background-color: rgba(255, 0, 0, 0.1);
            border-color: rgba(255, 0, 0, 0.3);
            color: #ffcccc;
        }

        .logout-btn:hover {
            background-color: rgba(255, 0, 0, 0.2);
            border-color: rgba(255, 0, 0, 0.5);
            color: white;
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - 80px);
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .header-center {
                order: 1;
            }

            .header-right {
                order: 2;
            }

            .auth-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .main-content {
                padding: 1rem;
            }
        }

        /* Flash Messages */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>

    @stack('styles')
</head>

<body>
    <header class="header">
        <div class="header-content">
            <a href="/" class="logo">Quiz App</a>

            <div class="header-center">
                <div class="current-date" id="current-date">
                    {{ date('l, F j, Y') }}
                </div>
            </div>

            <div class="header-right">
                @auth
                <div class="user-info">
                    <span class="user-name">Hello, {{ Auth::user()->name }}!</span>
                    @if(Auth::user()->is_admin)
                    <span class="admin-badge">Admin</span>
                    @endif
                </div>
                <a href="{{ route('logout') }}" class="auth-link logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link login">Login</a>
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="auth-link">Registration</a>
                    @endif
                </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        // Update date every minute
        function updateDate() {
            const dateElement = document.getElementById('current-date');
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            dateElement.textContent = now.toLocaleDateString('en-US', options);
        }

        // Update date immediately and then every minute
        updateDate();
        setInterval(updateDate, 60000);
    </script>

    @stack('scripts')
</body>

</html>