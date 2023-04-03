@extends('layout.auth')

@section('main')
<body>
    <div class="container">
        <div class="wrapper">
            <form class="auth-container" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="page-title">
                    <h2>LOG IN</h2>
                </div>

                <div class="form-container">
                    <input type="text" placeholder="username" required name="username">
                </div>

                <div class="form-container">
                    <input type="password" placeholder="password" required name="password">
                </div>

                <button class="button-submit" type="submit">Start Game</button>

                <span class="redirect">
                    No account? <a href="/register">Register here</a>
                </span>
            </form>
        </div>
    </div>
</body>
@endsection
