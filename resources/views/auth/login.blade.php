<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS System</title>
    <style>
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center;
               font-family: Arial, sans-serif; background-color: #f4f6f8; color: #222; }
        .login-card { background: #fff; width: 100%; max-width: 380px; padding: 30px; border-radius: 8px;
                      box-shadow: 0 2px 8px #00000015; box-sizing: border-box; }
        .login-card h1 { margin: 0 0 6px; font-size: 24px; }
        .login-card p.sub { margin: 0 0 20px; color: #6b7280; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 14px; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; border: 1px solid #d1d5db;
               border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .remember { display: flex; align-items: center; gap: 8px; font-size: 14px; margin-bottom: 16px; }
        button { width: 100%; padding: 11px; background: #1f2937; color: #fff; border: 0; border-radius: 6px;
                 font-size: 15px; cursor: pointer; }
        .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 16px; font-size: 14px; }
        .alert-error { background: #fee2e2; color: #991b1b; }
        .alert-success { background: #dcfce7; color: #166534; }
        .field-error { color: #b91c1c; font-size: 13px; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>POS System</h1>
        <p class="sub">Sign in with your staff account.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                       maxlength="50" required autofocus autocomplete="username">
                @error('username')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <label class="remember">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit">Log in</button>
        </form>
    </div>
</body>
</html>
