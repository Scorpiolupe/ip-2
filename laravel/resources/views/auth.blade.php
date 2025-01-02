<!-- layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #ffcf00, #000);
            color: #fff;
        }

        .container {
            width: 400px;
            padding: 40px;
            background-color: #fff;
            color: #000;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
        }

        .link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert-success {
            color:rgb(28, 114, 31);
            background-color:rgb(220, 248, 215);
            border: 1px solid rgb(220, 248, 215);
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            font-size: 14px;
        }


        .home-button {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 10px;
            background-color: rgba(255, 207, 0, 0.9);
            color: #000;
            text-decoration: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .home-button:hover {
            background-color: #000;
            color: #ffcf00;
            transform: scale(1.1);
        }

        .home-button svg {
            width: 20px;
            height: 20px;
            fill: #000;
            transition: fill 0.3s ease;
        }

        .home-button:hover svg {
            fill: #ffcf00;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('index') }}" class="home-button" title="Ana Sayfa">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 3l10 9h-3v9h-6v-6H9v6H3v-9H0l12-9z"/>
            </svg>
        </a>
        @yield('content')
    </div>
</body>
</html>
