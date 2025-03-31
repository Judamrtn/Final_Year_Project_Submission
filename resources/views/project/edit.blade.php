<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
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
        <!-- Notification Section -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1>Edit Project</h1>

        <form action="{{ route('projects.update', $project->ProjectCode) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Project Code -->
            <div class="form-group">
                <label for="ProjectCode">Project Code</label>
                <input type="text" class="form-control" id="ProjectCode" name="ProjectCode" value="{{ old('ProjectCode', $project->ProjectCode) }}" required readonly>
                @error('ProjectCode')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Name -->
            <div class="form-group">
                <label for="ProjectName">Project Name</label>
                <input type="text" class="form-control" id="ProjectName" name="ProjectName" value="{{ old('ProjectName', $project->ProjectName) }}" required>
                @error('ProjectName')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Problems -->
            <div class="form-group">
                <label for="ProjectProblems">Problems</label>
                <textarea class="form-control" id="ProjectProblems" name="ProjectProblems" rows="3" required>{{ old('ProjectProblems', $project->ProjectProblems) }}</textarea>
                @error('ProjectProblems')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Solutions -->
            <div class="form-group">
                <label for="ProjectSolutions">Solutions</label>
                <textarea class="form-control" id="ProjectSolutions" name="ProjectSolutions" rows="3" required>{{ old('ProjectSolutions', $project->ProjectSolutions) }}</textarea>
                @error('ProjectSolutions')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Abstract -->
            <div class="form-group">
                <label for="ProjectAbstract">Abstract</label>
                <textarea class="form-control" id="ProjectAbstract" name="ProjectAbstract" rows="3" required>{{ old('ProjectAbstract', $project->ProjectAbstract) }}</textarea>
                @error('ProjectAbstract')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Department Code -->
            <div class="form-group">
                <label for="DepartmentCode">Department Code</label>
                <select class="form-control" id="DepartmentCode" name="DepartmentCode" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->DepartmentCode }}" {{ old('DepartmentCode', $project->DepartmentCode) == $department->DepartmentCode ? 'selected' : '' }}>
                            {{ $department->DepartmentName }}
                        </option>
                    @endforeach
                </select>
                @error('DepartmentCode')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Dissertation -->
            <div class="form-group">
                <label for="ProjectDissertation">Upload Dissertation (PDF, DOC, DOCX)</label>
                <input type="file" class="form-control" id="ProjectDissertation" name="ProjectDissertation">
                @if ($project->ProjectDissertation)
                    <p>Current File: <a href="{{ asset('storage/' . $project->ProjectDissertation) }}" target="_blank">View Current Dissertation</a></p>
                @endif
                @error('ProjectDissertation')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Source Code -->
            <div class="form-group">
                <label for="ProjectSourceCodes">Upload Source Code (ZIP, RAR)</label>
                <input type="file" class="form-control" id="ProjectSourceCodes" name="ProjectSourceCodes">
                @if ($project->ProjectSourceCodes)
                    <p>Current File: <a href="{{ asset('storage/' . $project->ProjectSourceCodes) }}" target="_blank">View Current Source Code</a></p>
                @endif
                @error('ProjectSourceCodes')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>

        <a href="{{ route('student.studentdashboard') }}" class="btn btn-secondary btn-back">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JS (for dismissible alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
