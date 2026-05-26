@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    * { font-family: 'Plus Jakarta Sans', sans-serif; }

    body { background: #f0f2f5; }

    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: linear-gradient(160deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        position: fixed;
        left: 0; top: 0;
        z-index: 100;
        padding: 0;
        box-shadow: 4px 0 20px rgba(0,0,0,0.15);
    }

    .sidebar-brand {
        padding: 28px 24px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .sidebar-brand h4 {
        color: #fff;
        font-weight: 800;
        font-size: 1.1rem;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .sidebar-brand span {
        color: #f39c12;
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .sidebar-menu {
        padding: 16px 0;
    }

    .menu-label {
        color: rgba(255,255,255,0.35);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 12px 24px 6px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 24px;
        color: rgba(255,255,255,0.65);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        color: #fff;
        background: rgba(255,255,255,0.07);
        border-left-color: #f39c12;
    }

    .sidebar-menu a i {
        width: 18px;
        text-align: center;
        font-size: 0.9rem;
    }

    .main-content {
        margin-left: 260px;
        padding: 0;
        min-height: 100vh;
    }

    .topbar {
        background: #fff;
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 10px rgba(0,0,0,0.06);
        position: sticky;
        top: 0;
        z-index: 99;
    }

    .topbar h5 {
        margin: 0;
        font-weight: 700;
        color: #1a1a2e;
        font-size: 1.1rem;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .admin-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f9fa;
        border-radius: 50px;
        padding: 6px 16px 6px 6px;
        cursor: pointer;
    }

    .admin-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #f39c12, #e67e22);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
    }

    .admin-info small {
        display: block;
        color: #999;
        font-size: 0.7rem;
    }

    .admin-info span {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 0.85rem;
    }

    .content-area {
        padding: 32px;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border-radius: 16px;
        padding: 28px 32px;
        color: white;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -20px; top: -40px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        right: 60px; bottom: -60px;
        width: 150px; height: 150px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .welcome-banner h3 {
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 4px;
    }

    .welcome-banner p {
        opacity: 0.85;
        margin: 0;
        font-size: 0.9rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 16px;
    }

    .icon-orange { background: #fff3e0; color: #e67e22; }
    .icon-blue   { background: #e3f2fd; color: #1976d2; }
    .icon-green  { background: #e8f5e9; color: #388e3c; }
    .icon-red    { background: #fce4ec; color: #c62828; }

    .stat-card h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a2e;
        margin: 0 0 4px;
    }

    .stat-card p {
        color: #888;
        margin: 0;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .stat-card .trend {
        font-size: 0.78rem;
        font-weight: 600;
        margin-top: 8px;
    }

    .trend.up { color: #388e3c; }
    .trend.down { color: #c62828; }

    .section-title {
        font-weight: 700;
        color: #1a1a2e;
        font-size: 1rem;
        margin-bottom: 16px;
    }

    .card-box {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        height: 100%;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        background: #f8f9fa;
        text-decoration: none;
        color: #1a1a2e;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        margin-bottom: 10px;
    }

    .quick-action:last-child { margin-bottom: 0; }

    .quick-action:hover {
        background: #fff3e0;
        color: #e67e22;
        transform: translateX(4px);
    }

    .quick-action .qa-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .activity-item:last-child { border-bottom: none; }

    .activity-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-top: 5px;
        flex-shrink: 0;
    }

    .activity-item p {
        margin: 0;
        font-size: 0.85rem;
        color: #444;
        font-weight: 500;
    }

    .activity-item small {
        color: #aaa;
        font-size: 0.75rem;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 24px;
        color: rgba(255,100,100,0.8);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        border-left: 3px solid transparent;
        transition: all 0.2s;
        width: 100%;
        background: none;
        border-top: 1px solid rgba(255,255,255,0.06);
        cursor: pointer;
        margin-top: 8px;
    }

    .logout-btn:hover {
        color: #ff6b6b;
        background: rgba(255,100,100,0.08);
    }
</style>
@endpush

@section('content')
<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-brand">
            <h4>🏪 Kedai Mak Ayu</h4>
            <span>Admin Panel</span>
        </div>

        <div class="sidebar-menu">
            <div class="menu-label">Utama</div>
            <a href="{{ route('dashboard') }}" class="active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="menu-label">Kelola</div>
            <a href="#">
                <i class="fas fa-box"></i> Produk
            </a>
            <a href="#">
                <i class="fas fa-shopping-bag"></i> Pesanan
            </a>
            <a href="#">
                <i class="fas fa-users"></i> Pelanggan
            </a>
            <a href="#">
                <i class="fas fa-tags"></i> Kategori
            </a>

            <div class="menu-label">Laporan</div>
            <a href="#">
                <i class="fas fa-chart-bar"></i> Statistik
            </a>
            <a href="#">
                <i class="fas fa-file-alt"></i> Laporan
            </a>

            <div class="menu-label">Akun</div>
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-cog"></i> Profil
            </a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-100">

        {{-- TOPBAR --}}
        <div class="topbar">
            <h5>Dashboard Admin</h5>
            <div class="topbar-right">
                <div class="admin-badge">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="admin-info">
                        <span>{{ Auth::user()->name }}</span>
                        <small>Administrator</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content-area">

            {{-- WELCOME BANNER --}}
            <div class="welcome-banner">
                <h3>Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                <p>Kelola toko Kedai Mak Ayu dengan mudah dari sini.</p>
            </div>

            {{-- STAT CARDS --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon icon-orange">
                            <i class="fas fa-box"></i>
                        </div>
                        <h2>0</h2>
                        <p>Total Produk</p>
                        <div class="trend up"><i class="fas fa-arrow-up"></i> Tambah produk baru</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon icon-blue">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h2>0</h2>
                        <p>Total Pesanan</p>
                        <div class="trend up"><i class="fas fa-clock"></i> Belum ada pesanan</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon icon-green">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2>0</h2>
                        <p>Total Pelanggan</p>
                        <div class="trend up"><i class="fas fa-user-plus"></i> Daftar hari ini</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon icon-red">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h2>Rp 0</h2>
                        <p>Total Pendapatan</p>
                        <div class="trend down"><i class="fas fa-chart-line"></i> Bulan ini</div>
                    </div>
                </div>
            </div>

            {{-- QUICK ACTIONS & ACTIVITY --}}
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="section-title">⚡ Aksi Cepat</div>
                        <a href="#" class="quick-action">
                            <div class="qa-icon icon-orange"><i class="fas fa-plus"></i></div>
                            Tambah Produk Baru
                        </a>
                        <a href="#" class="quick-action">
                            <div class="qa-icon icon-blue"><i class="fas fa-list"></i></div>
                            Lihat Semua Pesanan
                        </a>
                        <a href="#" class="quick-action">
                            <div class="qa-icon icon-green"><i class="fas fa-users"></i></div>
                            Kelola Pelanggan
                        </a>
                        <a href="#" class="quick-action">
                            <div class="qa-icon icon-red"><i class="fas fa-chart-bar"></i></div>
                            Lihat Laporan
                        </a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-box">
                        <div class="section-title">🕐 Aktivitas Terbaru</div>
                        <div class="activity-item">
                            <div class="activity-dot" style="background:#e67e22"></div>
                            <div>
                                <p>Admin berhasil login</p>
                                <small>Baru saja · {{ now()->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot" style="background:#1976d2"></div>
                            <div>
                                <p>Sistem berhasil terhubung ke database Oracle</p>
                                <small>Hari ini</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot" style="background:#388e3c"></div>
                            <div>
                                <p>Aplikasi Kedai Mak Ayu siap digunakan</p>
                                <small>Hari ini</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection