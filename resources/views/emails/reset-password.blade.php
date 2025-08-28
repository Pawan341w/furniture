<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f2f4f6;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px 30px;
            text-align: center;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
            }

            .content {
                padding: 20px;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <h2>Hello!</h2>
            <p>You recently requested to reset your password for your {{ config('app.name') }} account. Click the button below to proceed:</p>
            <a href="{{ $resetUrl }}" class="btn" style="color:white !important;">Reset Password</a>
            <p>If you didn’t request a password reset, you can safely ignore this email.</p>
            <p>This password reset link will expire in 60 minutes.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
