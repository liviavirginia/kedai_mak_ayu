@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')
<section style="background: linear-gradient(135deg, #800000, #a52a2a); padding: 60px 0;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">RIWAYAT PESANAN</h1>
        <p class="lead">Daftar pesanan Anda</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($orders->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-shopping-bag fa-4x text-muted mb-3"></i>
                <h4>Belum Ada Pesanan</h4>
                <p class="text-muted">Anda belum melakukan pemesanan apapun</p>
                <a href="/user/menu" class="btn" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white; padding: 12px 30px; border-radius: 50px;">Mulai Belanja</a>
            </div>
        @else
            @foreach($orders as $order)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <strong>Invoice:</strong> {{ $order->invoice_number }}<br>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i> 
                                {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y H:i:s') }} WIB
                            </small>
                        </div>
                        <div class="mt-2 mt-sm-0">
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                            @elseif($order->status == 'processing')
                                <span class="badge bg-info px-3 py-2">Diproses</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success px-3 py-2">Selesai</span>
                            @else
                                <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-active">
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-danger">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt me-1 text-danger"></i> <strong>Alamat:</strong> {{ $order->shipping_address }}<br>
                            <i class="fas fa-phone me-1 text-danger"></i> <strong>No. HP:</strong> {{ $order->phone }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>
@endsection