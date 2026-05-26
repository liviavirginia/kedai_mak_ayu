@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4">
        <h5 class="mb-0">Profil Admin</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
            </div>
            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}" required>
            </div>
            <button type="submit" class="btn btn-primary-custom">Update Profil</button>
        </form>
    </div>
</div>
@endsection