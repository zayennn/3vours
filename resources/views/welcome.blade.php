<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - 3Vours</title>
    <link rel="stylesheet" href="{{ asset('assets/css/auth/style.css')}}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                <p>Welcome back! Please login to your account.</p>
            </div>
            
            {{-- form input --}}
            <form action="{{ route('index.login') }}" method="POST" id="loginForm" class="login-form">
                @csrf
                {{-- email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <span class="error-message" id="email-error"></span>
                </div>
                
                {{-- password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <span class="error-message" id="password-error"></span>
                </div>
                
                {{-- options --}}
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/auth/script.js') }}"></script>
</body>
</html>