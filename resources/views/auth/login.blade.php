<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Employee Attendance') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            font-family: Figtree, system-ui, sans-serif;
            background: #eef2f7;
            color: #111827;
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr);
        }

        .auth-panel {
            background:
                linear-gradient(rgba(17, 24, 39, .82), rgba(17, 24, 39, .82)),
                url('https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1400&q=80') center/cover;
            color: #fff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: .9rem;
            background: #2563eb;
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        .login-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f8fafc;
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .12);
        }

        .form-control {
            min-height: 48px;
            border-radius: .8rem;
        }

        .btn-primary {
            min-height: 48px;
            border-radius: .8rem;
            font-weight: 700;
            background: #2563eb;
            border-color: #2563eb;
        }

        .feature-pill {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 999px;
            padding: .55rem .85rem;
            color: #e5e7eb;
        }

        @media (max-width: 991.98px) {
            .auth-page { grid-template-columns: 1fr; }
            .auth-panel { min-height: 320px; padding: 2rem; }
        }

        @media (max-width: 575.98px) {
            .login-wrap { padding: 1rem; }
            .auth-panel { min-height: 260px; }
        }
    </style>
</head>
<body>
    <main class="auth-page">
        <section class="auth-panel">
            <div class="d-flex align-items-center gap-3">
                <div class="brand-mark">A</div>
                <div>
                    <div class="fw-bold fs-4">AttendancePro</div>
                    <div class="text-white-50 small">Employee Attendance System</div>
                </div>
            </div>

            <div class="my-5">
                <div class="badge text-bg-primary mb-3">Portfolio Ready</div>
                <h1 class="display-5 fw-bold mb-3">Manage attendance with clarity and confidence.</h1>
                <p class="lead text-white-50 mb-4">
                    Track employees, check-ins, check-outs, and activity logs from a clean Laravel dashboard.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="feature-pill">Secure login</span>
                    <span class="feature-pill">Employee CRUD</span>
                    <span class="feature-pill">Daily attendance</span>
                </div>
            </div>

            <div class="text-white-50 small">Built with Laravel 12, Blade, Bootstrap 5, and MySQL.</div>
        </section>

        <section class="login-wrap">
            <div class="card login-card">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-2">Welcome back</h2>
                        <p class="text-muted mb-0">Sign in to continue to your attendance dashboard.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus autocomplete="username">
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between gap-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="small text-decoration-none" href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password" required autocomplete="current-password">
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label text-muted" for="remember_me">Remember me</label>
                            </div>
                            @if (Route::has('register'))
                                <a class="small text-decoration-none" href="{{ route('register') }}">Create account</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Log in</button>
                    </form>

                    <div class="border-top mt-4 pt-4">
                        <div class="text-muted small mb-2">Demo account</div>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge text-bg-light border">admin@example.com</span>
                            <span class="badge text-bg-light border">password</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
