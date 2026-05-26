<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ==================== GUEST ROUTES ====================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::get('/login-admin', [AuthController::class, 'showAdminLoginForm']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// ==================== USER ROUTES ====================
Route::middleware('auth')->group(function () {
    Route::get('/user/home', [UserController::class, 'home']);
    Route::get('/user/about', [UserController::class, 'about']);
    Route::get('/user/menu', [UserController::class, 'menu']);
    Route::get('/user/contact', [UserController::class, 'contact']);
    
    // TAMBAHKAN NAMA ROUTE UNTUK SEMUA ROUTE USER
    Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
    
    Route::get('/user/cart/add/{productId}', [UserController::class, 'addToCart'])->name('user.cart.add');
    Route::post('/user/cart/update', [UserController::class, 'updateCart'])->name('user.cart.update');
    Route::get('/user/cart/remove/{cartId}', [UserController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::post('/user/checkout', [UserController::class, 'checkout'])->name('user.checkout');
});

// ==================== ADMIN ROUTES ====================
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/products', [AdminController::class, 'products']);
    Route::get('/products/create', [AdminController::class, 'createProduct']);
    Route::post('/products', [AdminController::class, 'storeProduct']);
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct']);
    Route::put('/products/{id}', [AdminController::class, 'updateProduct']);
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct']);
    
    Route::get('/orders', [AdminController::class, 'orders']);
    Route::get('/orders/{id}', [AdminController::class, 'showOrder']);
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus']);
    
    Route::get('/customers', [AdminController::class, 'customers']);
    Route::get('/customers/{id}', [AdminController::class, 'showCustomer']);
    
    Route::get('/categories', [AdminController::class, 'categories']);
    Route::post('/categories', [AdminController::class, 'storeCategory']);
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory']);
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory']);
    
    Route::get('/reports', [AdminController::class, 'reports']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::put('/profile', [AdminController::class, 'updateProfile']);
});

// ==================== REDIRECT ====================
Route::get('/home', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/home');
    }
    return redirect('/login');
});