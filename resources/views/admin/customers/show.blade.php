@extends('layouts.admin')

@section('page-title', 'Detail Pelanggan')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0">Detail Pelanggan</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ID Pelanggan</th>
                        <!-- PERBAIKAN: Tampilkan ID asli dari database -->
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $customer->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $customer->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Bergabung Sejak</th>
                        <td>{{ $customer->created_at ? $customer->created_at->translatedFormat('d F Y, H:i') : '-' }} WIB</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>
                            @if($customer->role == 'admin')
                                <span class="badge bg-danger">Administrator</span>
                            @else
                                <span class="badge bg-success">Pelanggan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="mb-3">Statistik Pesanan</h6>
                        <table class="table table-sm">
                            <tr>
                                <th>Total Pesanan</th>
                                <td>{{ $customer->orders->count() }}</td>
                            </tr>
                            <tr>
                                <th>Total Belanja</th>
                                <td>Rp {{ number_format($customer->orders->sum('total_amount'), 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Pesanan Selesai</th>
                                <td>{{ $customer->orders->where('status', 'completed')->count() }}</td>
                            </tr>
                            <tr>
                                <th>Pesanan Pending</th>
                                <td>{{ $customer->orders->where('status', 'pending')->count() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h6 class="mt-4">Riwayat Pesanan</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->orders as $order)
                    <tr>
                        <td>{{ $order->invoice_number }}</td>
                        <td>{{ $order->order_date ? $order->order_date->translatedFormat('d M Y, H:i') : '-' }} WIB</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->status == 'processing')
                                <span class="badge bg-info">Processing</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/admin/orders/'.$order->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ url('/admin/customers') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection