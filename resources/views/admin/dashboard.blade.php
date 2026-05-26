@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="text-muted">TOTAL PRODUK</h6>
                    <h2 class="mb-0">{{ $totalProducts }}</h2>
                    <small><i class="fas fa-plus text-success"></i> Tambah produk baru</small>
                </div>
                <div class="stat-icon" style="background: #e67e22; color: white;">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="text-muted">TOTAL PESANAN</h6>
                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                    <small><i class="fas fa-check-circle text-warning"></i> {{ $pendingOrders }} pending</small>
                </div>
                <div class="stat-icon" style="background: #3498db; color: white;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="text-muted">TOTAL PELANGGAN</h6>
                    <h2 class="mb-0">{{ $totalCustomers }}</h2>
                    <small><i class="fas fa-user-plus text-success"></i> Daftar hari ini</small>
                </div>
                <div class="stat-icon" style="background: #2ecc71; color: white;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="text-muted">TOTAL PENDAPATAN</h6>
                    <h2 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    <small><i class="fas fa-calendar text-info"></i> Bulan ini</small>
                </div>
                <div class="stat-icon" style="background: #e74c3c; color: white;">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary-custom w-100 mb-2">
                    <i class="fas fa-plus me-2"></i> Tambah Produk Baru
                </a>
                <a href="{{ url('/admin/orders') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-eye me-2"></i> Lihat Semua Pesanan
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-sign-in-alt text-success me-2"></i>
                        <strong>Admin berhasil login</strong><br>
                        <small class="text-muted">{{ now()->translatedFormat('d M Y, H:i') }}</small>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-database text-info me-2"></i>
                        <strong>Sistem berhasil terhubung ke database</strong><br>
                        <small class="text-muted">Hari ini</small>
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <strong>Aplikasi Kedai Mak Ayu siap digunakan</strong><br>
                        <small class="text-muted">Hari ini</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Pesanan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>{{ $order->invoice_number }}</td>
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $order->order_date ? $order->order_date->translatedFormat('d M Y, H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ url('/admin/orders/'.$order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada pesanan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection