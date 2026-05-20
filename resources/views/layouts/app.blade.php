<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Employee Attendance') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Figtree, system-ui, sans-serif; background: #f4f6f9; color: #111827; }
        .sidebar { width: 280px; min-height: 100vh; background: linear-gradient(180deg, #111827 0%, #172033 100%); }
        .brand-mark { width: 40px; height: 40px; border-radius: .8rem; background: #2563eb; display: grid; place-items: center; }
        .sidebar .nav-link { color: #cbd5e1; border-radius: .75rem; padding: .75rem 1rem; font-weight: 600; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #fff; background: #2563eb; }
        .content { min-height: 100vh; }
        .stat-card, .table-card { border: 0; border-radius: 1rem; box-shadow: 0 12px 32px rgba(15, 23, 42, .07); }
        .table thead th { color: #64748b; font-size: .78rem; letter-spacing: .02em; text-transform: uppercase; white-space: nowrap; }
        .table td, .table th { vertical-align: middle; }
        .avatar { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; }
        .toolbar-card { background: #fff; border: 0; border-radius: 1rem; box-shadow: 0 12px 32px rgba(15, 23, 42, .06); }
        .btn { font-weight: 600; }
        @media (max-width: 991.98px) {
            .sidebar { width: 100%; min-height: auto; }
            .sidebar .nav { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); }
            main.p-4 { padding: 1rem !important; }
        }
        @media (max-width: 575.98px) {
            .sidebar .nav { grid-template-columns: 1fr; }
            .header-actions { width: 100%; justify-content: space-between; }
        }
    </style>
</head>
<body>
    <div class="d-lg-flex">
        <aside class="sidebar p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fw-bold fs-4 d-flex align-items-center gap-3">
                    <span class="brand-mark">A</span>
                    <span>AttendancePro</span>
                </a>
            </div>
            <nav class="nav flex-column gap-2">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employees</a>
                <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}" href="{{ route('attendances.index') }}">Attendance</a>
                <a class="nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}" href="{{ route('activity-logs.index') }}">Activity Logs</a>
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Profile</a>
            </nav>
        </aside>

        <div class="content flex-grow-1">
            <header class="bg-white border-bottom px-4 py-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h1 class="h4 mb-0">{{ $title ?? 'Dashboard' }}</h1>
                        <div class="text-muted small">{{ now()->format('l, F j, Y') }}</div>
                    </div>
                    <div class="header-actions d-flex align-items-center gap-3">
                        <span class="text-muted small">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="fw-semibold mb-1">Please fix the following:</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
