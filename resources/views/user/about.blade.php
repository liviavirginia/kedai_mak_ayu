@extends('layouts.user')

@section('title', 'Tentang Kami')

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">TENTANG KAMI</h1>
        <p class="lead">Kenali lebih dekat Kedai Mak Ayu</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('uploads/Logo.png') }}" alt="Kedai Mak Ayu" class="img-fluid rounded-4 shadow-lg" style="width: 100%; height: 400px; object-fit: cover; background: #800000;">
            </div>
            <div class="col-md-6">
                <h2 class="display-6 fw-bold mb-4">Mengapa Memilih <span style="color: #800000;">Kedai Mak Ayu?</span></h2>
                <p class="lead mb-4">Kedai Mak Ayu menyediakan sembako berkualitas mulai dari beras, telur, gula, minyak goreng, hingga kebutuhan rumah tangga lainnya dengan harga bersahabat.</p>
                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fs-4 me-2" style="color: #800000;"></i>
                            <span>Produk Segar & Berkualitas</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fs-4 me-2" style="color: #800000;"></i>
                            <span>Harga Bersahabat</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fs-4 me-2" style="color: #800000;"></i>
                            <span>Pelayanan Ramah & Cepat</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fs-4 me-2" style="color: #800000;"></i>
                            <span>Pembayaran Cash di Tempat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection