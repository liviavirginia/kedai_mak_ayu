@extends('layouts.admin')

@section('page-title', 'Laporan')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0">Laporan Penjualan</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ url('/admin/reports') }}" class="row mb-4">
            <div class="col-md-3">
                <label>Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label>Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary-custom w-100">Filter</button>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <a href="{{ url('/admin/reports/export?start_date='.request('start_date').'&end_date='.request('end_date')) }}" class="btn btn-success w-100">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button onclick="window.print()" class="btn btn-info w-100">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </form>
        
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="alert alert-info">
                    <small>Total Pesanan</small>
                    <h3>{{ $totalOrders }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-success">
                    <small>Total Pendapatan</small>
                    <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning">
                    <small>Rata-rata per Pesanan</small>
                    <h3>Rp {{ number_format($averageOrder, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-primary">
                    <small>Total Produk Terjual</small>
                    <h3>{{ $totalItems }} item</h3>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="report-table">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Invoice</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_date ? $order->order_date->translatedFormat('d M Y') : '-' }}</td>
                        <td>{{ $order->invoice_number }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<style>
@media print {
    .sidebar, .topbar, form, .btn, .card-header .btn, .no-print {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection