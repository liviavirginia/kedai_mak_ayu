<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kedai Mak Ayu - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* WARNA MERAH MAROON */
        :root {
            --maroon: #800000;
            --maroon-light: #a52a2a;
            --maroon-dark: #4a0000;
            --bg-light: #fff8f0;
            --text-dark: #2c3e50;
            --white: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
        }
        
        /* Navbar */
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--maroon) !important;
        }
        
        .navbar-brand i {
            color: var(--maroon);
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
        }
        
        .nav-link:hover {
            color: var(--maroon) !important;
        }
        
        /* Page Header - MERAH MAROON */
        .page-header {
            background: linear-gradient(135deg, var(--maroon), var(--maroon-light));
            padding: 60px 0;
            color: var(--white);
        }
        
        /* Hero Section - MERAH MAROON */
        .hero-section {
            background: linear-gradient(135deg, var(--maroon), var(--maroon-light));
            padding: 100px 0;
            color: var(--white);
        }
        
        /* Buttons */
        .btn-maroon {
            background: linear-gradient(135deg, var(--maroon), var(--maroon-light));
            border: none;
            color: var(--white);
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .btn-maroon:hover {
            background: var(--maroon-dark);
            color: var(--white);
        }
        
        .btn-outline-maroon {
            border: 2px solid var(--maroon);
            color: var(--maroon);
            background: transparent;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .btn-outline-maroon:hover {
            background: var(--maroon);
            color: var(--white);
        }
        
        /* Product Card */
        .product-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .product-price {
            color: var(--maroon);
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, var(--maroon), var(--maroon-light));
            border: none;
            color: var(--white);
            padding: 10px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
        }
        
        /* Contact Card */
        .contact-card {
            background: var(--white);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
            height: 100%;
            transition: 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
        }
        
        .contact-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--maroon), var(--maroon-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .contact-icon i {
            font-size: 2rem;
            color: var(--white);
        }
        
        /* Footer */
        .footer {
            background: #1a1a2e;
            color: var(--white);
            padding: 50px 0 30px;
            margin-top: 50px;
        }
        
        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }
        
        .footer a:hover {
            color: var(--maroon-light);
        }
        
        /* Cart Badge */
        .cart-badge {
            position: relative;
            color: var(--text-dark);
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: var(--maroon);
            color: var(--white);
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            .hero-section h1 {
                font-size: 1.8rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/user/home">
            <i class="fas fa-store"></i> Kedai Mak Ayu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/user/home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/about">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/contact">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="/user/cart" class="cart-badge me-3">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    @php 
                        $count = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); 
                    @endphp
                    @if($count > 0)
                        <span class="cart-count">{{ $count }}</span>
                    @endif
                </a>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/user/orders"><i class="fas fa-box me-2"></i> Pesanan Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<main style="margin-top: 80px;">
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="mb-3"><i class="fas fa-store me-2"></i> Kedai Mak Ayu</h5>
                <p>Menyediakan sembako berkualitas dengan harga bersahabat untuk kebutuhan harian Anda.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="/user/home">Home</a></li>
                    <li><a href="/user/about">Tentang</a></li>
                    <li><a href="/user/menu">Menu</a></li>
                    <li><a href="/user/contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Kontak</h5>
                <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Cengkeh 5 No.1, Medan Tuntungan</p>
                <p class="mb-2"><i class="fas fa-phone me-2"></i> +62 822-1530-9714</p>
                <p><i class="fas fa-envelope me-2"></i> info@kedaimakayu.com</p>
            </div>
        </div>
        <div class="text-center pt-4 border-top border-secondary">
            <p class="mb-0">&copy; 2024 Kedai Mak Ayu - Sembako Berkualitas Harga Bersahabat</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
</script>
@stack('scripts')
</body>
</html>