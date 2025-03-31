<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            flex: 1; /* Grow to fill remaining space */
            margin-left: 270px;
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
        }
    </style>
</head>
<body>
    @include('student.sidebar', ['student' => $student])

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <div class="navbar">
            <h3 class="mb-0">Welcome, {{ $student->StudentFirstName }}!</h3>
            <a href="{{ route('logout') }}#}" class="btn btn-danger">Logout</a>
        </div>

        <!-- Cards -->
        <div class="cards">
            <div class="card">
                <i class="fas fa-project-diagram fa-3x mb-3 text-primary"></i>
                <h3>My Projects</h3>
                <p class="display-4">{{ $projects->count() }}</p>
            </div>
            <div class="card">
                <i class="fas fa-users fa-3x mb-3 text-success"></i>
                <h3>Supervisors</h3>
                <p class="display-4">{{ $supervisorCount }}</p>
            </div>
        </div>

        <!-- Projects Table -->
        <h2 class="mt-4">My Projects</h2>
        <div class="table-container mt-3">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Project Name</th>
                        <th>Status</th>
                        <th>Supervisor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->ProjectName }}</td>
                            <td>
                                <span class="badge bg-{{ $project->Status === 'Approved' ? 'success' : ($project->Status === 'Pending' ? 'warning' : 'danger') }}">
                                    {{ $project->Status }}
                                </span>
                            </td>
                            <td>{{ $project->supervisor->SupervisorName ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('projects.view', $project->ProjectCode) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('projects.edit', $project->ProjectCode) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project->ProjectCode) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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