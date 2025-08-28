<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>

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
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Join us today! It takes only a few steps</h6>

                            <form class="pt-3" method="POST" action="{{ route('register.process') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="name" class="form-control form-control-sm border-left-0" id="name" placeholder="Full Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-email-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control form-control-sm border-left-0" id="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-phone text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="tel" name="mobile" class="form-control form-control-sm border-left-0" id="mobile" placeholder="Mobile Number" required>
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

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-check text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control form-control-sm border-left-0" id="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="image">Profile Image(Optional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-image text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="file" name="image" class="form-control form-control-sm border-left-0" id="image" accept="image/*">
                                    </div>
                                </div>
                                

                                <div class="my-3 d-grid gap-2">
                                    <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="REGISTER">
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="text-primary">Login</a>
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
