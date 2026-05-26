@extends('layouts.user')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #800000, #a52a2a); padding: 100px 0; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Mari Belanja Kebutuhan Harian</h1>
        <p class="lead">Menyediakan sembako berkualitas dengan harga bersahabat</p>
        <a href="/user/menu" class="btn btn-light btn-lg rounded-pill px-5 mt-3">
            Belanja Sekarang <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<!-- Produk Unggulan -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-dark">Produk Unggulan</h2>
            <div style="width: 80px; height: 4px; background: linear-gradient(135deg, #800000, #a52a2a); border-radius: 2px; margin: 0 auto;"></div>
        </div>
        <div class="row">
            @foreach($products->take(8) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center">
                        @if($product->photo && file_exists(public_path($product->photo)))
                            <img src="{{ asset($product->photo) }}" style="height: 120px; object-fit: cover;" class="mb-3 rounded">
                        @else
                            <i class="fas fa-box-open fa-4x mb-3" style="color: #800000;"></i>
                        @endif
                        <h5>{{ $product->name }}</h5>
                        <div class="text-danger fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="/user/cart/add/{{ $product->id }}" class="btn w-100 mt-3" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white; border-radius: 12px;">
                            <i class="fas fa-cart-plus me-2"></i> Tambah Keranjang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="/user/menu" class="btn btn-outline-danger btn-lg rounded-pill px-5" style="border: 2px solid #800000; color: #800000;">
                Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endsection