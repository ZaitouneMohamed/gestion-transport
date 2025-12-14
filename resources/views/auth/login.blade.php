<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - A&J Transport et Logistique</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login_container {
            width: 100%;
            max-width: 1100px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: grid;
            grid-template-columns: 45% 55%;
            min-height: 650px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left_section {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .logo {
            text-align: center;
            margin-bottom: 50px;
        }

        .logo img {
            width: 180px;
            margin-bottom: 10px;
        }

        .logo h2 {
            color: #2d3748;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .logo p {
            color: #718096;
            font-size: 14px;
        }

        .form_group {
            margin-bottom: 25px;
            position: relative;
        }

        .form_group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input_wrapper {
            position: relative;
        }

        .input_wrapper input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
            color: #2d3748;
        }

        .input_wrapper input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input_wrapper input::placeholder {
            color: #a0aec0;
        }

        .icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 18px;
        }

        .forgot_password {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 30px;
        }

        .forgot_password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot_password a:hover {
            color: #1e3a8a;
        }

        .submit_btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .submit_btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
        }

        .submit_btn:active {
            transform: translateY(0);
        }

        .error_message {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .right_section {
            background: linear-gradient(rgba(30, 58, 138, 0.85), rgba(59, 130, 246, 0.85)),
                        url('https://aetjtransportetlogistique.ma/images/global images/Isuzu NPR HD.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .right_section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .welcome_text {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .welcome_text h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 0.8s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome_text p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .features {
            margin-top: 40px;
            display: flex;
            gap: 30px;
            position: relative;
            z-index: 1;
        }

        .feature_item {
            text-align: center;
            animation: fadeInUp 0.8s ease-out 0.4s backwards;
        }

        .feature_icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(10px);
            font-size: 24px;
        }

        .feature_item p {
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 968px) {
            .login_container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .right_section {
                display: none;
            }

            .left_section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .left_section {
                padding: 30px 20px;
            }

            .logo h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login_container">
        <div class="left_section">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="A&J Transport et Logistique Logo" style="width: 180px; margin-bottom: 20px;">
                <h2>Welcome Back</h2>
                <p>Login to access your account</p>
            </div>

            <form method="POST" action="{{ route('login_c') }}" id="loginForm">
                @csrf
                @method('POST')

                <div class="form_group">
                    <label for="email">Email Address</label>
                    <div class="input_wrapper">
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                        <span class="icon">📧</span>
                    </div>
                    @error('email')
                        <span class="error_message" style="display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form_group">
                    <label for="password">Password</label>
                    <div class="input_wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                        <span class="icon">🔒</span>
                    </div>
                    @error('password')
                        <span class="error_message" style="display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forgot_password">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="submit_btn">Sign In</button>
            </form>
        </div>

        <div class="right_section">
            <div class="welcome_text">
                <h1>A&J</h1>
                <p>Transport et Logistique</p>
                <p>Your trusted logistics partner</p>
                <p>Delivering excellence across Morocco</p>
            </div>

            <div class="features">
                <div class="feature_item">
                    <div class="feature_icon">🚚</div>
                    <p>Fast Delivery</p>
                </div>
                <div class="feature_item">
                    <div class="feature_icon">📦</div>
                    <p>Secure Shipping</p>
                </div>
                <div class="feature_item">
                    <div class="feature_icon">⭐</div>
                    <p>Premium Service</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
