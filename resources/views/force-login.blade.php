<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset</title>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1cc88a 0%, #36b9cc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .card {
            width: 500px;
            max-width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .card-body {
            padding: 30px;
        }
        .btn-healthcare {
            background: linear-gradient(135deg, #1cc88a 0%, #36b9cc 100%);
            border: none;
            color: white;
        }
        .btn-healthcare:hover {
            background: linear-gradient(135deg, #36b9cc 0%, #1cc88a 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-4">Admin Access Reset</h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <p class="mb-4">This page allows you to create or reset the admin account when you're having trouble accessing the system.</p>
            
            <form action="{{ route('force-login') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-healthcare btn-user btn-block">
                    <i class="fas fa-key mr-1"></i> Reset Admin Account
                </button>
            </form>
            
            <div class="text-center">
                <small class="text-muted">This will create or update the admin account with these credentials:</small>
                <div class="mt-2 p-3 bg-light rounded">
                    <p class="mb-1"><strong>Email:</strong> admin@ehealth.com</p>
                    <p class="mb-0"><strong>Password:</strong> password</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
