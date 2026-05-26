@extends('layouts.admin')

@section('page-title', 'Profil Admin')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-center">
            <div class="card-body">
                <div class="mb-3">
                    <div class="avatar-circle mx-auto" style="width: 100px; height: 100px; background: #e67e22; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user fa-4x text-white"></i>
                    </div>
                </div>
                <h4>{{ $admin->name }}</h4>
                <p class="text-muted">
                    <i class="fas fa-envelope me-1"></i> {{ $admin->email }}<br>
                    <i class="fas fa-phone me-1"></i> {{ $admin->phone ?? 'Belum diisi' }}
                </p>
                <span class="badge bg-danger">Administrator</span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Edit Profil</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/profile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label>No. Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}">
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="address" class="form-control" rows="3">{{ $admin->address }}</textarea>
                    </div>
                    <hr>
                    <h6>Ganti Password</h6>
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="new_password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                    <div class="mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection