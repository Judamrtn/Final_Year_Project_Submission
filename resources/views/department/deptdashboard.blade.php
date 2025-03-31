<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Dashboard</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c1fc850206.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Ensure footer stays at the bottom */
            min-height: 100vh; /* Full viewport height */
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            background: #1abc9c;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            flex: 1; /* Allow content to grow and push footer down */
            position: relative; /* For positioning the logout button */
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-button button {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-button button:hover {
            background: #1abc9c;
        }

        .footer {
            margin-left: 250px;
            padding: 15px;
            background: #2c3e50;
            color: white;
            text-align: center;
            font-size: 14px;
        }

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

        .table-container {
            display: flex;
            justify-content: center;
        }

        table {
            width: 80%;
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

        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .assign {
            background: #2ecc71;
        }

        .assign:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('department.sidebar')

    <!-- Main Content -->
    <div class="content">
        <!-- Logout Button -->
        <div class="logout-button">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

       <center><h1>Department Dashboard</h1></center> 

        <div class="cards">
            <div class="card">
                <i class="fas fa-user-tie"></i>
                <h3>Total Supervisors</h3>
                <p>{{ $totalSupervisors }}</p>
            </div>
            <div class="card">
                <i class="fas fa-graduation-cap"></i>
                <h3>Total Students</h3>
                <p>{{ $totalStudents }}</p>
            </div>
            <div class="card">
                <i class="fas fa-tasks"></i>
                <h3>Projects Assigned</h3>
                <p>{{ $totalAssignedProjects }}</p>
            </div>
        </div>

       <center> <h2>Assign Supervisor to Student</h2></center>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Project Name</th>
                        <th>Assign Supervisor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <!-- Display Student First and Last Name -->
                            <td>{{ $student->StudentFirstName }} {{ $student->StudentLastName }}</td>

                            <!-- Display the Project Name or a message if no project assigned -->
                            <td>{{ $student->project ? $student->project->ProjectName : 'No Project Assigned' }}</td>

                            <td>
                                <form action="{{ route('assign.supervisor') }}" method="POST">
                                    @csrf
                                    <!-- Hidden input for student ID -->
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                                    <!-- Dropdown to select supervisor -->
                                    <select name="supervisor_id">
                                        @foreach(\App\Models\Supervisor::all() as $supervisor)
                                            <option value="{{ $supervisor->id }}"
                                                {{ $student->project && $student->project->supervisor_id == $supervisor->id ? 'selected' : '' }}>
                                                {{ $supervisor->SupervisorEmail }} <!-- Display Supervisor's email -->
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- Assign Button -->
                                    <button type="submit" class="assign"><i class="fas fa-check"></i> Assign</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Department Dashboard. All rights reserved.</p>
    </div>
</body>
</html>