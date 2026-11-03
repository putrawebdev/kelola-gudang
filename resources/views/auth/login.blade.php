<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Kelola Gudang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">
    <form class="login-card" action="{{ route('login.store') }}" method="POST">
        @csrf
        <h1>Login</h1>

        @if ($errors->any())
            <div style="color:#ffb3b3;font-size:13px;text-align:center;margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="field">
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=" " required autofocus>
            <label for="email">Email</label>
        </div>

        <div class="field">
            <input type="password" id="password" name="password" placeholder=" " required>
            <label for="password">Password</label>
        </div>

        <div class="login-options">
            <label class="check"><input type="checkbox" name="remember"> Remember me</label>
        </div>

        <button type="submit" class="btn-login btn-log">Log In</button>
    </form>
</body>
</html>
