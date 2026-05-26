<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // HAPUS constructor middleware - Laravel 12 tidak perlu

    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        // Cek apakah user admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts', 'totalCustomers', 'totalOrders', 
            'totalRevenue', 'pendingOrders', 'recentOrders'
        ));
    }

    // ==================== MANAJEMEN PRODUK ====================
    public function products()
    {
    if (Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak!');
    }
    
    // Urutkan dari ID terkecil ke terbesar
    $products = Product::orderBy('id', 'asc')->paginate(12);
    
    return view('admin.products.index', compact('products'));
   }

    public function createProduct()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('uploads/products'), $filename);
            $product->photo = 'uploads/products/' . $filename;
        }
        
        $product->save();
        
        return redirect('/admin/products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function editProduct($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('uploads/products'), $filename);
            $product->photo = 'uploads/products/' . $filename;
        }
        
        $product->save();
        
        return redirect('/admin/products')->with('success', 'Produk berhasil diupdate');
    }

    public function deleteProduct($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus');
    }

    // ==================== MANAJEMEN PESANAN ====================
    public function orders()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate');
    }

    // ==================== MANAJEMEN PELANGGAN ====================
    public function customers()
    {
       if (Auth::user()->role !== 'admin') {
           return redirect('/')->with('error', 'Akses ditolak!');
    }
    
    // HANYA TAMPILKAN USER DENGAN ROLE 'user' (BUKAN ADMIN)
    $customers = User::where('role', 'user')->orderBy('created_at', 'desc')->paginate(10);
    return view('admin.customers.index', compact('customers'));
    }

    public function showCustomer($id)
    {
    if (Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak!');
    }
    
    // Perbaikan: Cari user berdasarkan ID dan role user
    $customer = User::where('id', $id)->where('role', 'user')->first();
    
    // Jika tidak ditemukan, coba cari tanpa filter role (untuk debugging)
    if (!$customer) {
        $customer = User::find($id);
        if (!$customer) {
            abort(404, 'Pelanggan tidak ditemukan');
        }
    }
    
    return view('admin.customers.show', compact('customer'));
    }

    // ==================== MANAJEMEN KATEGORI ====================
    public function categories()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);
        
        Category::create($request->all());
        return redirect('/admin/categories')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateCategory(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak!');
    }
    
    $category = Category::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $id,
        'description' => 'nullable|string'
    ]);
    
    $category->update([
        'name' => $request->name,
        'description' => $request->description
    ]);
    
    return redirect('/admin/categories')->with('success', 'Kategori berhasil diupdate');
}

    public function deleteCategory($id)
    {
    if (Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak!');
    }
    
    $category = Category::findOrFail($id);
    
    // Cek apakah kategori memiliki produk
    if ($category->products()->count() > 0) {
        return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk!');
    }
    
    $category->delete();
    return redirect('/admin/categories')->with('success', 'Kategori berhasil dihapus');
    }

    // ==================== LAPORAN ====================
    public function reports(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $startDate = $request->start_date ? date('Y-m-d', strtotime($request->start_date)) : date('Y-m-01');
        $endDate = $request->end_date ? date('Y-m-d', strtotime($request->end_date)) : date('Y-m-t');
        
        $orders = Order::with('user')
            ->whereBetween('order_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('order_date', 'desc')
            ->get();
        
        $totalOrders = $orders->count();
        $totalRevenue = $orders->where('status', 'completed')->sum('total_amount');
        $averageOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $totalItems = OrderItem::whereIn('order_id', $orders->pluck('id'))->sum('quantity');
        
        return view('admin.reports.index', compact('orders', 'totalOrders', 'totalRevenue', 'averageOrder', 'totalItems'));
    }

    public function exportReport(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        return redirect()->back()->with('info', 'Fitur export sedang dalam pengembangan');
    }

    // ==================== PROFIL ADMIN ====================
    public function profile()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $admin = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'new_password' => 'nullable|min:6|confirmed'
        ]);
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        
        if ($request->new_password) {
            $admin->password = Hash::make($request->new_password);
        }
        
        $admin->save();
        
        return redirect('/admin/profile')->with('success', 'Profil berhasil diupdate');
    }
}