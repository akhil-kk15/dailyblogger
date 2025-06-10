<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .blocked-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .blocked-icon {
            color: #dc3545;
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        .blocked-title {
            color: #333;
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .blocked-message {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .blocked-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        
        .logout-form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="blocked-container">
        <div class="blocked-icon">
            <i class="fas fa-ban"></i>
        </div>
        
        <h1 class="blocked-title">Access Restricted</h1>
        
        <p class="blocked-message">
            Your account has been temporarily blocked. You can still browse public content, 
            but access to user-specific features is restricted.
        </p>
        
        <p class="blocked-message" style="font-size: 0.9rem; color: #999;">
            If you believe this is an error, please contact the administrator.
        </p>
        
        <div class="blocked-actions">
            <a href="{{ route('home.homepage') }}" class="btn btn-primary">
                <i class="fas fa-home"></i> Go to Homepage
            </a>
            
            <a href="{{ route('home.posts') }}" class="btn btn-secondary">
                <i class="fas fa-newspaper"></i> Browse Posts
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
