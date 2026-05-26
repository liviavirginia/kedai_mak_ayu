<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - Kedai Mak Ayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #800000, #a52a2a);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #800000, #a52a2a);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .login-body {
            padding: 40px;
        }
        .btn-login {
            background: linear-gradient(135deg, #800000, #a52a2a);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            color: white;
        }
        .btn-login:hover {
            background: #4a0000;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <div class="login-header">
                        <i class="fas fa-user-shield fa-3x mb-3"></i>
                        <h3>KEDAI MAK AYU</h3>
                        <p class="mb-0">Login Admin</p>
                    </div>
                    <div class="login-body">
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="/login">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email Admin</label>
                                <input type="email" name="email" class="form-control" value="admin@kedaimakayu.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="admin123" required>
                            </div>
                            <button type="submit" class="btn-login">Login Admin</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a href="/login" class="text-muted">Login sebagai User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>