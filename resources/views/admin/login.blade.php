<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login - eHealth Management System</title>

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        .bg-healthcare {
            background: linear-gradient(135deg, #1cc88a 0%, #36b9cc 100%);
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
        .healthcare-logo {
            max-width: 80px;
            margin-bottom: 20px;
        }
        .bg-login-healthcare {
            background: url('https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1041&q=80');
            background-position: center;
            background-size: cover;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .card-body {
            border-radius: 15px;
        }
        .login-header {
            color: #1cc88a;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-healthcare">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-healthcare"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('img/undraw_medicine_b1ol.svg') }}" alt="Healthcare Logo" class="healthcare-logo">
                                        <h1 class="h3 login-header mb-4">eHealth Management</h1>
                                        <p class="text-muted mb-4">Secure Admin Portal</p>
                                    </div>
                                    
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    
                                    <form class="user" method="POST" action="{{ route('admin.login.submit') }}" autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                                id="email" name="email" 
                                                placeholder="Enter Email Address..." 
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" 
                                                id="password" name="password" 
                                                placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-healthcare btn-user btn-block shadow-lg">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Secure Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center mt-3">
                                        <small class="text-muted font-weight-bold">Default: admin@ehealth.com / password</small>
                                    </div>
                                    <div class="text-center mt-2">
                                        <small class="text-muted"> 2025 eHealth Management System. All rights reserved.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
