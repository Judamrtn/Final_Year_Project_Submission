<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c1fc850206.js" crossorigin="anonymous"></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Sidebar */
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

        /* Logout Button */
        .logout-button {
            width: 100%;
            background: #e74c3c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .logout-button i {
            margin-right: 10px;
        }

        .logout-button:hover {
            background: #c0392b;
        }

        /* Main Content */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            text-align: center;
        }

        /* Cards */
        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 200px;
        }

        .card h3 {
            margin: 0;
            color: #333;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
            color: #2c3e50;
        }

        .card i {
            font-size: 40px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* Table */
        .table-container {
            display: flex;
            justify-content: center;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background: #34495e;
            color: white;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        /* Buttons */
        .actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            margin: 5px;
        }

        .approve {
            background: #2ecc71;
        }

        .deny {
            background: #e74c3c;
        }

        .view {
            background: #3498db;
        }

        .approve:hover, .deny:hover, .view:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .content {
                margin-left: 0;
                width: 100%;
            }
            
            .cards {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
            }

            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Supervisor Panel</h2>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-project-diagram"></i> My Assigned Projects</a></li>
            <li><a href="#"><i class="fas fa-users"></i> View Students</a></li>
            <li><a href="#"><i class="fas fa-check-circle"></i> Approve Proposals</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li>
                <form action="{{ route('supervisor.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Supervisor Dashboard</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="cards">
            <div class="card">
                <i class="fas fa-project-diagram"></i>
                <h3>Assigned Projects</h3>
                <p>{{ $projects->count() }}</p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Assigned Students</h3>
                <p>{{ $projects->unique('StudentRegNumber')->count() }}</p>
            </div>
            <div class="card">
                <i class="fas fa-check-circle"></i>
                <h3>Proposals to Approve</h3>
                <p>{{ $projects->where('Status', 'Pending')->count() }}</p>
            </div>
        </div>

        <h2>My Assigned Projects</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Status</th>
                        <th>Student</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->ProjectName }}</td>
                            <td>{{ $project->Status }}</td>
                            <td>{{ $project->student->StudentName ?? 'N/A' }}</td>
                            <td class="actions">
                                <button class="view"><i class="fas fa-eye"></i> View</button>
                                <form action="{{ route('project.approve', $project->ProjectCode) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="approve"><i class="fas fa-check"></i> Approve</button>
                                </form>
                                <form action="{{ route('project.deny', $project->ProjectCode) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="deny"><i class="fas fa-times"></i> Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
