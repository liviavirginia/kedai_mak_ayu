@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4">
        <h5 class="mb-0">Pengaturan Toko</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Toko</label>
                <input type="text" name="store_name" class="form-control" value="Kedai Mak Ayu">
            </div>
            <div class="mb-3">
                <label>Alamat Toko</label>
                <textarea name="store_address" class="form-control" rows="2">Jl. Pasar Baru No. 123, Jakarta</textarea>
            </div>
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="store_phone" class="form-control" value="+62 812-3456-7890">
            </div>
            <div class="mb-3">
                <label>Email Toko</label>
                <input type="email" name="store_email" class="form-control" value="info@kedaimakayu.com">
            </div>
            <button type="submit" class="btn btn-primary-custom">Simpan Pengaturan</button>
        </form>
    </div>
</div>
@endsection