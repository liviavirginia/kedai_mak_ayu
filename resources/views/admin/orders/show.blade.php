@extends('layouts.admin')

@section('page-title', 'Detail Pesanan')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0">Detail Pesanan - {{ $order->invoice_number }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Informasi Pelanggan</h6>
                <table class="table table-sm">
                    <tr><th>Nama</th><td>{{ $order->user->name ?? '-' }}</td></tr>
                    <tr><th>Email</th><td>{{ $order->user->email ?? '-' }}</td></tr>
                    <tr><th>No. HP</th><td>{{ $order->phone }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $order->shipping_address }}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Informasi Pesanan</h6>
                <table class="table table-sm">
                    <tr><th>Invoice</th><td>{{ $order->invoice_number }}</td></tr>
                    <tr><th>Tanggal</th><td>{{ $order->order_date ? $order->order_date->translatedFormat('d F Y H:i:s') : '-' }} WIB</td></tr>
                    <tr><th>Status</th><td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-info">Processing</span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td></tr>
                    <tr><th>Total</th><td><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td></tr>
                </table>
            </div>
        </div>
        
        <hr>
        <h6>Produk yang Dipesan</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
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
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-4">
            <a href="{{ url('/admin/orders') }}" class="btn btn-secondary">Kembali</a>
            <form action="{{ url('/admin/orders/'.$order->id.'/status') }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <select name="status" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                </select>
            </form>
        </div>
    </div>
</div>
@endsection