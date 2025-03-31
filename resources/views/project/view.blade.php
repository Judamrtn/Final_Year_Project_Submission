<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
        }

        .card {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 20px;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('student.sidebar', ['student' => $student])

    <div class="container">
        <h1>Project Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $project->ProjectName }}</h5>
                <p class="card-text"><strong>Problems:</strong> {{ $project->ProjectProblems }}</p>
                <p class="card-text"><strong>Solutions:</strong> {{ $project->ProjectSolutions }}</p>
                <p class="card-text"><strong>Abstract:</strong> {{ $project->ProjectAbstract }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $project->Status }}</p>
                <p class="card-text"><strong>Supervisor:</strong> {{ $project->supervisor->SupervisorName ?? 'N/A' }}</p>
            </div>
        </div>

        <a href="{{ route('student.studentdashboard') }}" class="btn btn-primary btn-back">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
