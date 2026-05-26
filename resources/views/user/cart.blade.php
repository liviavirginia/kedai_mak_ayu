@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@section('content')
<section style="background: linear-gradient(135deg, #800000, #a52a2a); padding: 60px 0;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">KERANJANG BELANJA</h1>
        <p class="lead">Daftar belanja Anda</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($carts->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4>Keranjang Belanja Kosong</h4>
                <p class="text-muted">Silakan pilih produk terlebih dahulu</p>
                <a href="/user/menu" class="btn" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white; padding: 12px 30px; border-radius: 50px;">Mulai Belanja</a>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            @foreach($carts as $cart)
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <div>
                                    <h5 class="mb-1">{{ $cart->product->name }}</h5>
                                    <div class="text-danger fw-bold">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <form action="/user/cart/update" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" style="width: 60px;" class="form-control form-control-sm me-2">
                                        <button type="submit" class="btn btn-sm btn-outline-primary me-2">Update</button>
                                    </form>
                                    <a href="/user/cart/remove/{{ $cart->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h5 class="mb-3">Ringkasan Belanja</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Item:</span>
                                <strong>{{ $carts->sum('quantity') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Total Harga:</span>
                                <strong class="text-danger fs-4">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>
                            <hr>
                            <form action="/user/checkout" method="POST">
                                @csrf
                                <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white; padding: 12px; border-radius: 50px;">
                                    Checkout <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </form>
                            <p class="text-muted small text-center mt-3">Pembayaran Cash di Tempat</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection