@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4">
        <h5 class="mb-0">Edit Produk</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>
            <div class="mb-3">
                <label>Foto (opsional)</label>
                <input type="file" name="photo" class="form-control">
                @if($product->photo)
                    <small class="text-muted">Foto saat ini: {{ $product->photo }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary-custom">Update</button>
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection