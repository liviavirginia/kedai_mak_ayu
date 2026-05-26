@extends('layouts.user')

@section('title', 'Menu Produk')

@section('content')
<section style="background: linear-gradient(135deg, #800000, #a52a2a); padding: 60px 0;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">MENU KAMI</h1>
        <p class="lead">Pilih kebutuhan sembako Anda di sini</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <div class="position-relative">
                    <i class="fas fa-search position-absolute" style="left: 18px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                    <input type="text" id="searchProduct" class="form-control rounded-pill py-3" placeholder="Cari produk..." style="padding-left: 45px;">
                </div>
            </div>
        </div>
        
        <div class="row" id="product-list">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item" data-name="{{ strtolower($product->name) }}">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body text-center">
                        @if($product->photo && file_exists(public_path($product->photo)))
                            <img src="{{ asset($product->photo) }}" style="height: 120px; object-fit: cover;" class="mb-3 rounded">
                        @else
                            <i class="fas fa-box-open fa-4x mb-3" style="color: #800000;"></i>
                        @endif
                        <h5>{{ $product->name }}</h5>
                        <div class="text-danger fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="text-muted small">Stok: {{ $product->stock }}</div>
                        <a href="/user/cart/add/{{ $product->id }}" class="btn w-100 mt-3" style="background: linear-gradient(135deg, #800000, #a52a2a); color: white; border-radius: 12px;">
                            <i class="fas fa-cart-plus me-2"></i> Tambah Keranjang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.getElementById('searchProduct').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    let items = document.querySelectorAll('.product-item');
    items.forEach(item => {
        let name = item.getAttribute('data-name');
        if (name.includes(value)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
@endsection