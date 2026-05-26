<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Mak Ayu - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #e67e22;
            --secondary: #f39c12;
            --dark: #2c3e50;
            --light: #fef9e7;
        }
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background-color: var(--light);
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-primary-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(230,126,34,0.3);
        }
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .product-body {
            padding: 15px;
        }
        .product-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }
        .btn-add-cart {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 8px 15px;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .btn-add-cart:hover {
            background: var(--secondary);
            transform: scale(1.02);
        }
        .hero-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 60px 0;
            color: white;
            border-radius: 0 0 30px 30px;
        }
        .footer {
            background: var(--dark);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
        .cart-badge {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
        }
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.home') }}">
            <i class="fas fa-store me-2"></i>KEDAI MAK AYU
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarUser">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.about') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.menu') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.contact') }}">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="{{ route('user.cart') }}" class="cart-badge text-white me-3">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    @php
                        $count = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    @if($count > 0)
                        <span class="cart-count">{{ $count }}</span>
                    @endif
                </a>
                <div class="dropdown">
                    <button class="btn btn-link text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar d-inline-flex">
                            <i class="fas fa-user"></i>
                        </div>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('user.orders') }}"><i class="fas fa-box me-2"></i> Pesanan Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="footer">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 Kedai Mak Ayu - Sembako Berkualitas Harga Bersahabat</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if(session('success'))
<script>alert("{{ session('success') }}");</script>
@endif
@if(session('error'))
<script>alert("{{ session('error') }}");</script>
@endif
</body>
</html>