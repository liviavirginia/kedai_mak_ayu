@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4">
        <h5 class="mb-0">Detail Pesanan - {{ $order->invoice_number }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>No HP:</strong> {{ $order->phone }}</p>
                <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Order:</strong> {{ $order->order_date->translatedFormat('d F Y H:i:s') }} WIB</p>
                <p><strong>Status:</strong> 
                    @if($order->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($order->status == 'processing')
                        <span class="badge bg-info">Processing</span>
                    @elseif($order->status == 'completed')
                        <span class="badge bg-success">Completed</span>
                    @else
                        <span class="badge bg-danger">Cancelled</span>
                    @endif
                </p>
                <p><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            </div>
        </div>
        
        <hr>
        <h6>Produk yang Dipesan</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
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
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Kembali</a>
            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="d-inline">
                @csrf
                <select name="status" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>
    </div>
</div>
@endsection