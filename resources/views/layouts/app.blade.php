<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eHealth Management System</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            min-height: 100vh;
            background: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .sidebar .nav-link {
            color: #5a5c69;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 0.35rem;
            margin: 0.2rem 0;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--primary-color);
            background-color: #f8f9fa;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        
        .main-content {
            padding: 1.5rem;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #4e73df;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .mobile-menu-toggle {
            display: none;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1040;
                transition: left 0.3s ease-in-out;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1050;
            }
            
            .main-content {
                margin-left: 0 !important;
                padding-top: 4rem;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="btn btn-primary mobile-menu-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 p-0 sidebar" id="sidebar">
                <div class="d-flex flex-column">
                    <div class="py-4 px-3 text-center">
                        <span class="logo-text">eHealth MS</span>
                    </div>
                    <hr class="mx-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('programs.create') }}" class="nav-link {{ request()->routeIs('programs.create') ? 'active' : '' }}">
                                <i class="fas fa-plus-circle"></i> Create Program
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.create') }}" class="nav-link {{ request()->routeIs('clients.create') ? 'active' : '' }}">
                                <i class="fas fa-user-plus"></i> Register Client
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('program.register.form') }}" class="nav-link {{ request()->routeIs('program.register.form') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list"></i> Enroll Client
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.search') }}" class="nav-link {{ request()->routeIs('clients.search') ? 'active' : '' }}">
                                <i class="fas fa-search"></i> Search Client
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-10 main-content ms-auto">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 992 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target) && 
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
        
        // Flash message support
        const flashSuccess = "{{ session('success') }}";
        const flashError = "{{ session('error') }}";
        
        if (flashSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: flashSuccess,
                timer: 3000,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });
        }
        
        if (flashError) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: flashError,
                timer: 3000,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });
        }
    </script>
</body>
</html>
