<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisors</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c1fc850206.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            background: #1abc9c;
        }

        /* Main Content Styles */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        .table-responsive {
            margin-top: 20px;
        }

        .btn-add {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('department.sidebar')

    <!-- Main Content -->
    <div class="content">
        <h1>Supervisors</h1>

        <!-- Add Supervisor Button -->
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addSupervisorModal">
            <i class="fas fa-plus"></i> Add Supervisor
        </button>

        <!-- Supervisors Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Project Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supervisors as $supervisor)
                        <tr>
                            <td>{{ $supervisor->SupervisorEmail }}</td>
                            <td>{{ $supervisor->SupervisorFirstName }}</td>
                            <td>{{ $supervisor->SupervisorLastName }}</td>
                            <td>{{ $supervisor->SupervisorPhoneNumber }}</td>
                            <td>{{ $supervisor->ProjectCode ?? 'No Project Assigned' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('supervisors.edit', $supervisor->SupervisorEmail) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('supervisors.destroy', $supervisor->SupervisorEmail) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this supervisor?')">
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

    <!-- Add Supervisor Modal -->
    <div class="modal fade" id="addSupervisorModal" tabindex="-1" aria-labelledby="addSupervisorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupervisorModalLabel">Add Supervisor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSupervisorForm" action="{{ route('supervisors.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="SupervisorEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="SupervisorEmail" name="SupervisorEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="SupervisorFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="SupervisorFirstName" name="SupervisorFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="SupervisorLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="SupervisorLastName" name="SupervisorLastName" required>
                        </div>
                        <div class="mb-3">
                            <label for="SupervisorPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="SupervisorPhoneNumber" name="SupervisorPhoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="ProjectCode" class="form-label">Project Code (Optional)</label>
                            <input type="text" class="form-control" id="ProjectCode" name="ProjectCode">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="addSupervisorForm" class="btn btn-primary">Add Supervisor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>