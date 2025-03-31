<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RP | Final Year Project Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero {
            background: url('your-image.jpg') no-repeat center center/cover;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 20px;
        }
        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .dropdown-menu {
            min-width: 200px; /* Adjust dropdown width */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">RP | FYP Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Projects</a></li>

                    <!-- Dropdown for Login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                            <li><a class="dropdown-item" href="{{ route('student.login') }}">Login as Student</a></li>
                            <li><a class="dropdown-item" href="{{ route('supervisor.first-login') }}">Login as Supervisor</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.login') }}">Login as Department</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown for Register -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Register
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="registerDropdown">
                            <li><a class="dropdown-item" href="{{ route('student.showregister') }}">Register as Student</a></li>
                            <li><a class="dropdown-item" href="{{ route('supervisor.first-login') }}">Register as Supervisor</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-overlay">
            <h1 class="display-4">Welcome to RP Final Year Project Portal</h1>
            <p class="lead">Find, Submit, and Track your Final Year Projects with ease.</p>
            <a href="#" class="btn btn-primary btn-lg"><i class="fas fa-book"></i> Explore Projects</a>
        </div>
    </header>

    <!-- Features Section -->
    <div class="container py-5">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                <h3>Student Portal</h3>
                <p>Manage your final year projects and interact with supervisors.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-chalkboard-teacher fa-3x text-success"></i>
                <h3>Supervisor Portal</h3>
                <p>Guide students through their projects and provide feedback.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-folder-open fa-3x text-warning"></i>
                <h3>Project Repository</h3>
                <p>Search and review previously completed final year projects.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 RP Final Year Project Portal | Designed for Excellence</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>