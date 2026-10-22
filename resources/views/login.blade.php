<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Inventory Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            background: #f4f6f9;
            color: #1f2937;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.10);
            display: flex;
        }

        /* =========================
           LEFT SECTION
        ========================= */

        .login-left {
            width: 50%;
            background: linear-gradient(145deg, #1e3a8a, #2563eb);
            padding: 55px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
            top: -100px;
            right: -90px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            bottom: -80px;
            left: -70px;
        }

        .brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .left-content h1 {
            font-size: 42px;
            line-height: 1.15;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .left-content p {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.82);
            max-width: 430px;
            margin-bottom: 30px;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.92);
        }

        .feature-item i {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .copyright {
            position: relative;
            z-index: 2;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.65);
        }

        /* =========================
           RIGHT SECTION
        ========================= */

        .login-right {
            width: 50%;
            padding: 55px 65px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 390px;
        }

        .login-heading {
            margin-bottom: 32px;
        }

        .login-heading .small-title {
            color: #2563eb;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 9px;
        }

        .login-heading h2 {
            font-size: 31px;
            font-weight: 700;
            margin: 0 0 9px;
            color: #111827;
        }

        .login-heading p {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper > i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 17px;
            z-index: 2;
        }

        .form-control {
            height: 50px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding-left: 45px;
            padding-right: 45px;
            font-size: 14px;
            box-shadow: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #9ca3af;
            padding: 3px;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #2563eb;
        }

        .login-btn {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .login-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 7px 18px rgba(37, 99, 235, 0.20);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .forgot-password {
            color: #2563eb;
            font-size: 13px;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .security-note {
            margin-top: 24px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #eef2f7;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 9px;
            color: #64748b;
            font-size: 12px;
        }

        .security-note i {
            color: #16a34a;
            font-size: 15px;
        }

        .alert {
            border-radius: 9px;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .login-container {
                max-width: 600px;
            }

            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                padding: 55px 50px;
            }
        }

        @media (max-width: 500px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-container {
                min-height: auto;
                border-radius: 18px;
            }

            .login-right {
                padding: 40px 25px;
            }

            .login-heading h2 {
                font-size: 27px;
            }
        }


        .login-toast {
    position: fixed;
    top: 25px;
    right: 25px;
    min-width: 320px;
    max-width: 400px;
    padding: 14px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 9999;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    animation: toastSlideIn 0.35s ease;
}

.success-toast {
    background: #ffffff;
    border-left: 4px solid #16a34a;
}

.error-toast {
    background: #ffffff;
    border-left: 4px solid #dc2626;
}

.toast-icon {
    width: 34px;
    height: 34px;
    min-width: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-toast .toast-icon {
    background: #dcfce7;
    color: #16a34a;
}

.error-toast .toast-icon {
    background: #fee2e2;
    color: #dc2626;
}

.toast-content {
    display: flex;
    flex-direction: column;
    gap: 2px;
    flex: 1;
}

.toast-content strong {
    font-size: 14px;
    color: #1f2937;
}

.toast-content span {
    font-size: 13px;
    color: #6b7280;
}

.toast-close {
    border: none;
    background: transparent;
    color: #9ca3af;
    font-size: 18px;
    cursor: pointer;
    padding: 3px;
}

.toast-close:hover {
    color: #374151;
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateX(100%);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 500px) {
    .login-toast {
        top: 15px;
        right: 15px;
        left: 15px;
        min-width: auto;
        max-width: none;
    }
}

    </style>
</head>

<body>


@if(session('success'))
    <div class="login-toast success-toast">
        <div class="toast-icon">
            <i class="bi bi-check-lg"></i>
        </div>

        <div class="toast-content">
            <strong>Success</strong>
            <span>{{ session('success') }}</span>
        </div>

        <button type="button" class="toast-close" onclick="closeToast(this)">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="login-toast error-toast">
        <div class="toast-icon">
            <i class="bi bi-exclamation-lg"></i>
        </div>

        <div class="toast-content">
            <strong>Error</strong>
            <span>{{ session('error') }}</span>
        </div>

        <button type="button" class="toast-close" onclick="closeToast(this)">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif



<div class="login-wrapper">


    <div class="login-container">

  

        <!-- =========================
             LEFT SIDE
        ========================== -->

        <div class="login-left">

            <div class="brand">

                <div class="brand-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="brand-name">
                    InventoryPro
                </div>

            </div>


            <div class="left-content">

                <h1>
                    Manage your inventory<br>
                    with confidence.
                </h1>

                <p>
                    Keep your products, suppliers, purchases and
                    inventory operations organized from one powerful
                    management system.
                </p>

                <div class="feature-list">

                    <div class="feature-item">
                        <i class="bi bi-check-lg"></i>
                        <span>Manage products and categories</span>
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-check-lg"></i>
                        <span>Track purchases and suppliers</span>
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-check-lg"></i>
                        <span>Monitor your inventory efficiently</span>
                    </div>

                </div>

            </div>


            <div class="copyright">
                © {{ date('Y') }} InventoryPro. All rights reserved.
            </div>

        </div>


        <!-- =========================
             RIGHT SIDE
        ========================== -->

        <div class="login-right">

            <div class="login-form-wrapper">

                <div class="login-heading">

                    <div class="small-title">
                        Admin Portal
                    </div>

                    <h2>
                        Welcome back
                    </h2>

                    <p>
                        Sign in to access your inventory dashboard.
                    </p>

                </div>


                <!-- Error Message -->

                @if($errors->any())

                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>

                        {{ $errors->first() }}
                    </div>

                @endif


                <!-- Login Form -->

                <form action="{{ url('logged_in') }}" method="POST">
                    @csrf
                    <!-- Email -->

                    <div class="mb-3">

                        <label class="form-label">
                            Mobile Number
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-envelope"></i>

                            <input
                                type="number"
                                name="mobile_number"
                                class="form-control"
                                placeholder="Enter your Mobile Number"
                                value="{{ old('mobile_number') }}"
                                
                                required
                            >

                        </div>

                        @error('mobile_number')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <!-- Password -->

                    <div class="mb-3">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <label class="form-label mb-0">
                                Password
                            </label>

                            <a href="#" class="forgot-password">
                                Forgot password?
                            </a>

                        </div>


                        <div class="input-wrapper">

                            <i class="bi bi-lock"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                            >
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>

                        </div>

                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <!-- Remember Me -->

                    <div class="d-flex align-items-center mb-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                                style="font-size: 13px; color: #6b7280;"
                            >
                                Remember me
                            </label>

                        </div>

                    </div>


                    <!-- Login Button -->

                    <button type="submit" class="login-btn">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Sign In
                    </button>

                </form>


                <!-- Security Note -->

                <div class="security-note">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Your login information is securely protected.
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

    function togglePassword()
    {
        const password = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');

        if (password.type === 'password') {

            password.type = 'text';

            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');

        } else {

            password.type = 'password';

            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');

        }
    }

</script>

</body>
</html>
