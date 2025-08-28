<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password | {{ get_setting('app_name', 'App Name') }}</title>

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">

    <!-- Purple Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-light/style.css') }}">
    <link rel="shortcut icon" href="{{ get_setting('mini_logo') }}">
    
    <style>
        body {
            background-color: #f4f6f9;
        }
        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .auth-box {
            background: #fff;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        .auth-logo {
            display: block;
            margin: 0 auto 25px;
            max-width: 150px;
        }
        .form-group label {
            font-weight: 600;
        }
    </style>
</head>

<body>
<div class="auth-wrapper">
    <div class="auth-box">
        @if(get_setting('logo'))
            <img src="{{ asset(get_setting('logo')) }}" alt="Logo" class="auth-logo">
        @endif

        <h4 class="text-center mb-4">Forgot Your Password?</h4>

        @if (session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email.custom') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control"
                       placeholder="Enter your registered email"
                       required autofocus>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Send Reset Link</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</div>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- Purple Admin JS -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>
</html>
