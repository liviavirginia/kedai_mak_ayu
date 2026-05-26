<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Mak Ayu</title>
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
        }
        
        .welcome-card {
            background: white;
            border-radius: 30px;
            padding: 60px 50px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 90%;
            margin: 0 auto;
        }
        
        .welcome-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #800000, #a52a2a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .welcome-icon i {
            font-size: 2.5rem;
            color: white;
        }
        
        .welcome-card h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #800000;
            margin-bottom: 15px;
        }
        
        .welcome-card p {
            color: #666;
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        .btn-maroon {
            background: linear-gradient(135deg, #800000, #a52a2a);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            margin: 5px;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-maroon:hover {
            transform: scale(1.05);
            background: #4a0000;
            color: white;
        }
        
        .btn-outline-maroon {
            border: 2px solid #800000;
            color: #800000;
            background: transparent;
            padding: 10px 23px;
            border-radius: 50px;
            font-weight: 600;
            margin: 5px;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-outline-maroon:hover {
            background: #800000;
            color: white;
        }
        
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .welcome-card {
                padding: 40px 25px;
            }
            .welcome-card h1 {
                font-size: 1.5rem;
            }
            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
            .btn-maroon, .btn-outline-maroon {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <div class="welcome-icon">
            <i class="fas fa-store"></i>
        </div>
        <h1>KEDAI MAK AYU</h1>
        <p>Menyediakan sembako berkualitas dengan harga bersahabat</p>
        <div class="btn-group">
            <a href="/login" class="btn-maroon">Login User</a>
            <a href="/register" class="btn-outline-maroon">Daftar</a>
            <a href="/login-admin" class="btn-maroon">Login Admin</a>
        </div>
    </div>
</body>
</html>
