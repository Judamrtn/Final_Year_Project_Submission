<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%; /* Full height */
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column; /* Stack content vertically */
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            flex: 1; /* Grow to fill remaining space */
            margin-left: 270px; /* Match sidebar width */
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 250px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .fas, .fa {
            font-family: 'Font Awesome 5 Free' !important;
            font-weight: 900;
        }

        footer {
            flex-shrink: 0; /* Prevent footer from shrinking */
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            margin-left: 270px; /* Match sidebar width */
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('student.sidebar', ['student' => $student])

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <div class="navbar">
            <h3 class="mb-0">Welcome, {{ $student->StudentFirstName }}!</h3>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>

        <!-- Supervisor Information -->
        <h2 class="mt-4">Supervisor Information</h2>
        <div class="table-container mt-3">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                @if($supervisor)
    <p><strong>Supervisor Name:</strong> {{ $supervisor->name }}</p> <!-- Display supervisor's name -->
    <p><strong>Email:</strong> {{ $supervisor->SupervisorEmail }}</p> <!-- Display supervisor's email -->
@else
    <p>No supervisor assigned yet.</p>
@endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2025 Student Dashboard. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>