<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Kedai Mak Ayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #e67e22;
            --secondary: #f39c12;
            --dark: #2c3e50;
            --sidebar-width: 280px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100%;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
        }
        .sidebar-header p {
            font-size: 12px;
            opacity: 0.7;
            margin: 5px 0 0;
        }
        .sidebar-nav {
            padding: 20px 0;
        }
        .nav-section {
            padding: 0 15px;
            margin-bottom: 10px;
        }
        .nav-section-title {
            font-size: 12px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 10px;
            margin: 2px 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        .sidebar-nav .nav-link i {
            width: 25px;
            margin-right: 10px;
            font-size: 18px;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar-nav .nav-link.active {
            background: var(--primary);
            color: white;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
        }
        .topbar {
            background: white;
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
        }
        .btn-primary-custom:hover {
            transform: scale(1.02);
        }
        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }
        .table-custom thead {
            background: var(--dark);
            color: white;
        }
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-store fa-2x" style="color: var(--primary);"></i>
        <h4>Kedai Mak Ayu</h4>
        <p>Admin Panel</p>
    </div>
    <div class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">UTAMA</div>
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{ url('/admin/products') }}">
                <i class="fas fa-box"></i> Produk
            </a>
            <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{ url('/admin/orders') }}">
                <i class="fas fa-shopping-cart"></i> Pesanan
            </a>
            <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}" href="{{ url('/admin/customers') }}">
                <i class="fas fa-users"></i> Pelanggan
            </a>
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ url('/admin/categories') }}">
                <i class="fas fa-tags"></i> Kategori
            </a>
            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ url('/admin/reports') }}">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
            <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}" href="{{ url('/admin/profile') }}">
                <i class="fas fa-user-cog"></i> Profil
            </a>
        </div>
    </div>
    <div class="p-3 position-absolute bottom-0 w-100">
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <h5 class="page-title">@yield('page-title')</h5>
        <div class="d-flex align-items-center">
            <i class="fas fa-bell me-3 fs-5 text-muted"></i>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/admin/profile') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')

@if(session('success'))
<script>alert("{{ session('success') }}");</script>
@endif
@if(session('error'))
<script>alert("{{ session('error') }}");</script>
@endif
</body>
</html>