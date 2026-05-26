@extends('layouts.admin')

@section('page-title', 'Edit Produk')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0">Edit Produk: {{ $product->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ url('/admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Foto Saat Ini</label>
                    @if($product->photo && file_exists(public_path($product->photo)))
                        <div class="mb-2">
                            <img src="{{ asset($product->photo) }}" style="max-width: 150px;" class="rounded">
                        </div>
                    @endif
                    <label>Ganti Foto (opsional)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <div class="mt-2">
                        <img id="preview" src="#" alt="Preview" style="max-width: 150px; display: none;">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary-custom">Update</button>
            <a href="{{ url('/admin/products') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
@endsection