<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Planner</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            background: #f4f6f9;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
            border-right: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 800;
            color: #0d1b2a;
            letter-spacing: -.3px;
            display: block;
            margin-bottom: 3px;
        }

        .brand-sub {
            font-size: 11px;
            color: #adb5bd;
            font-weight: 400;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 10px;
            overflow-y: auto;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 13px;
            color: #6c757d;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 2px;
            font-size: 14px;
            font-weight: 500;
            transition: background .15s, color .15s;
        }

        .sidebar-link i {
            width: 16px;
            text-align: center;
            font-size: 13px;
            color: #ced4da;
            transition: color .15s;
            flex-shrink: 0;
        }

        .sidebar-link:hover {
            background: #f3f6fb;
            color: #185FA5;
        }

        .sidebar-link:hover i {
            color: #185FA5;
        }

        .sidebar-link.active {
            background: #E6F1FB;
            color: #185FA5;
            font-weight: 600;
        }

        .sidebar-link.active i {
            color: #185FA5;
        }

        /* user card at bottom */
        .sidebar-footer {
            border-top: 1px solid #e9ecef;
            padding: 16px 14px;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            margin-bottom: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #E6F1FB;
            color: #185FA5;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .user-avatar img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .user-info {
            min-width: 0;
            flex: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: #0d1b2a;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: #adb5bd;
            margin-top: 1px;
        }

        .logout-btn {
            width: 100%;
            background: transparent;
            border: 1px solid #e9ecef;
            color: #6c757d;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            transition: background .15s, color .15s, border-color .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #fff0f0;
            border-color: #f5c6cb;
            color: #dc3545;
        }

        .main-content {
            margin-left: 255px;
            padding: 20px 24px;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 13px 20px;
            border-radius: 14px;
            margin-bottom: 22px;
            border: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-left {
            display: flex;
            flex-direction: column;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 800;
            color: #0d1b2a;
            margin: 0;
            line-height: 1.2;
        }

        .topbar-date {
            font-size: 11px;
            color: #adb5bd;
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user {
            text-align: right;
        }

        .topbar-name {
            font-size: 13px;
            font-weight: 700;
            color: #0d1b2a;
            line-height: 1.2;
        }

        .topbar-role {
            font-size: 11px;
            color: #adb5bd;
        }

        .topbar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #E6F1FB;
            color: #185FA5;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid #E6F1FB;
        }

        .topbar-avatar img {
            width: 34px;
            height: 34px;
            object-fit: cover;
            display: block;
        }

        /* Cards */
        .card-box {
            border: 1px solid #e9ecef;
            border-radius: 14px;
            background: #fff;
        }

        /* Table */
        .table-box {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #e9ecef;
        }

        .table th {
            font-size: 11px;
            color: #adb5bd;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
        }

        .table td {
            font-size: 14px;
            color: #495057;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #f4f6f9;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

    <div class="sidebar-brand">
        <span class="brand-name">Study Planner</span>
    </div>

    <!-- Nav -->
    <div class="sidebar-nav">

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a href="{{ route('assignments') }}"
           class="sidebar-link {{ request()->routeIs('assignments') ? 'active' : '' }}">
            <i class="fa-solid fa-book-open"></i>
            Assignments
        </a>

        <a href="{{ route('users') }}"
           class="sidebar-link {{ request()->routeIs('users') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            Users
        </a>

        <a href="{{ route('profile') }}"
           class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

    </div>

    <div class="sidebar-footer">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Log out
            </button>
        </form>

    </div>

</div>

<div class="main-content">

    <!-- Topbar -->
<div class="topbar justify-content-end">
    <div class="topbar-right">
        <div class="topbar-user text-end">
            <div class="topbar-name">
                {{ Auth::user()->name }}
            </div>
            <div class="topbar-role">
                Student
            </div>
        </div>

        <div class="topbar-avatar">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                     alt="{{ Auth::user()->name }}">
            @else
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            @endif
        </div>
    </div>
</div>

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const d = new Date();
    const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
    document.getElementById('topbar-date').textContent = d.toLocaleDateString('en-US', opts);
</script>

</body>
</html>