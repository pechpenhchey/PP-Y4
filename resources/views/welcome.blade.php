<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our Website</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .background {
            background-image: url('https://images.unsplash.com/photo-1490818387583-1baba5e638af?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.5;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            position: relative;
            margin-left: 20px; /* Adjust this value as needed */
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #FF2D20;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #E6271F;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
                margin-left: 0; /* Reset margin for smaller screens */
            }
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <h1>Welcome to Our Website</h1>
        <p>We're excited to have you here. Explore our services and discover what we have to offer.</p>
        <a href="{{ route('login') }}" class="btn">Log in</a>
        <a href="{{ route('register') }}" class="btn">Register</a>
    </div>
</body>
</html>
