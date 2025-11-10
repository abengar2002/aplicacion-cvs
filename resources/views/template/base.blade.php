<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Gestor de CVs</title>

    <style>
        body { 
            font-family: sans-serif; 
            margin: 0; 
            background-color: #f4f7f6;
            color: #333;
        }
        .container { 
            max-width: 900px; 
            margin: auto;
            padding: 20px;
        }
        h1, h2, h3 {
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea.form-control { min-height: 100px; }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card-header { padding: 15px 20px; background-color: #f9f9f9; border-bottom: 1px solid #eee; }
        .card-header h4 { margin: 0; }
        .card-body { padding: 20px; }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .btn {
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-danger { background-color: #dc3545; color: white; }
    </style>
    
</head>
<body>

    <div class="container">
        
        @yield('content')
        
    </div>

</body>
</html>