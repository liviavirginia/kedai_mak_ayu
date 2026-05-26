<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Kedai Mak Ayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #800000, #a52a2a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        /* Card dengan semua sudut bulat 40px */
        .register-card {
            background: white;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
        }
        
        /* Header juga bulat di atas */
        .register-header {
            background: linear-gradient(135deg, #800000, #a52a2a);
            padding: 40px 20px;
            text-align: center;
            color: white;
            border-radius: 40px 40px 0 0;
        }
        
        .register-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .register-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .register-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .register-body {
            padding: 35px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 15px;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            border-color: #800000;
            outline: none;
        }
        
        textarea.form-control {
            resize: vertical;
            border-radius: 15px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #800000, #a52a2a);
            border: none;
            padding: 14px;
            border-radius: 15px;
            font-weight: 600;
            width: 100%;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .btn-register:hover {
            background: #4a0000;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .login-link a {
            color: #800000;
            text-decoration: none;
            font-weight: 600;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <i class="fas fa-store"></i>
            <h3>KEDAI MAK AYU</h3>
            <p>Daftar Akun Baru</p>
        </div>
        <div class="register-body">
            @if($errors->any())
                <div class="alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="/register">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control" placeholder="Masukkan no. telepon" value="{{ old('phone') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat" required>{{ old('address') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
                </div>
                
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i> Daftar
                </button>
            </form>
            
            <div class="login-link">
                <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
                <a href="/" class="text-muted small">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
