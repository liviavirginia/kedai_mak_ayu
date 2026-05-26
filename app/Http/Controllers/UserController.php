<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function home()
    {
        $products = Product::all();
        return view('user.home', compact('products'));
    }

    public function about()
    {
        return view('user.about');
    }

    public function menu()
    {
        $products = Product::all();
        return view('user.menu', compact('products'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function cart()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }
        return view('user.cart', compact('carts', 'total'));
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $checkCart = Cart::where('user_id', Auth::id())
                         ->where('product_id', $productId)
                         ->first();
        
        if ($checkCart) {
            $checkCart->quantity = $checkCart->quantity + 1;
            $checkCart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->product_id = $productId;
            $cart->quantity = 1;
            $cart->save();
        }
        
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        if ($cart && $cart->user_id == Auth::id()) {
            if ($request->quantity <= 0) {
                $cart->delete();
            } else {
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        }
        // GANTI redirect()->route() dengan redirect()
        return redirect('/user/cart')->with('success', 'Keranjang berhasil diupdate');
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
        }
        // GANTI redirect()->route() dengan redirect()
        return redirect('/user/cart')->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        
        if ($carts->isEmpty()) {
            // GANTI redirect()->route() dengan redirect()
            return redirect('/user/cart')->with('error', 'Keranjang belanja kosong');
        }

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }
        
        $order = new Order();
        $order->user_id = Auth::id();
        $order->invoice_number = 'INV/' . date('YmdHis') . '/' . rand(100000, 999999);
        $order->total_amount = $total;
        $order->status = 'pending';
        $order->shipping_address = Auth::user()->address;
        $order->phone = Auth::user()->phone;
        $order->order_date = Carbon::now();
        $order->save();

        foreach ($carts as $cart) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;
            $orderItem->quantity = $cart->quantity;
            $orderItem->price = $cart->product->price;
            $orderItem->save();
            
            $product = Product::find($cart->product_id);
            $product->stock = $product->stock - $cart->quantity;
            $product->save();
        }
        
        Cart::where('user_id', Auth::id())->delete();
        
        // GANTI redirect()->route() dengan redirect()
        return redirect('/user/orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product')
                       ->orderBy('order_date', 'desc')
                       ->get();
        return view('user.orders', compact('orders'));
    }
}