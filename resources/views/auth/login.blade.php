<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ config('app.name') }}</title>

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
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo text-center mb-3">
                                <img src="{{ get_setting('logo') }}" alt="logo">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy to see you again!</h6>

                            <form class="pt-3" method="POST" action="{{ route('login.process') }}">
                                @csrf
                                 <div class="form-group">
                                    <label for="login">Email or Mobile Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="login" class="form-control form-control-sm border-left-0" id="login" placeholder="Enter Email or Mobile" value="{{ old('login') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-sm border-left-0" id="password" placeholder="Password" required>
                                    </div>
                                </div>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in
                                        </label>
                                    </div>
                                    <!--<a href="#" class="auth-link text-primary">Forgot password?</a>-->
                                    <a href="{{ route('password.request.custom') }}" class="auth-link text-primary">Forgot password?</a>

                                </div>

                                <div class="my-3 d-grid gap-2">
                                    <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="LOGIN">
                                </div>



                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 login-half-bg d-flex flex-row" style="background-image: url('{{ asset(get_setting('banner')) }}');">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                            Copyright &copy; 2021 All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            const errors = @json($errors->all());
            let i = 0;

            Swal.fire({
                title: 'Please Wait',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                backdrop: 'rgba(0,0,0,0.9)',
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                Swal.close();

                function showNextError() {
                    if (i < errors.length) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: errors[i],
                            backdrop: true,
                        }).then(() => {
                            i++;
                            showNextError();
                        });
                    }
                }

                showNextError();
            }, 1500);
        </script>
    @endif

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
