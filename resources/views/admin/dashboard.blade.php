<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
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

        /* Main Content */
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            text-align: center;
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

        .add-supervisor {
            background: #1abc9c;
        }

        .view-supervisor {
            background: #3498db;
        }

        .add-supervisor:hover, .view-supervisor:hover {
            opacity: 0.8;
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

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Modal Title */
        .modal-content h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #34495e;
            text-align: center;
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        /* Form Styling */
        .modal input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .modal button {
            width: 100%;
            padding: 10px;
            background-color: #1abc9c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #16a085;
        }

        /* Responsive Styling */
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

            .table-container {
                width: 100%;
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
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-building"></i> Departments</a></li>
            <li><a href="supervisors.html"><i class="fas fa-user-tie"></i> Supervisors</a></li>
            <li><a href="#"><i class="fas fa-user-graduate"></i> Students</a></li>
            <li><a href="#"><i class="fas fa-tasks"></i> Projects</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="actions">
            <!-- Add Supervisor Button -->
            <button id="addSupervisorBtn" class="add-supervisor"><i class="fas fa-user-plus"></i> Add New Supervisor</button>
            <button class="view-supervisor"><i class="fas fa-eye"></i> View Supervisors</button>
        </div>

        <div class="table-container">
            <!-- Your supervisor table or content goes here -->
            <table>
                <tbody>
                    <!-- Rows will go here -->
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Smith</td>
                        <td>Johnson</td>
                        <td>smith@rp.ac.rw</td>
                        <td>+250 789 123 456</td>
                        <td class="actions">
                            <button class="edit"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Prof. Johnson</td>
                        <td>Smith</td>
                        <td>johnson@rp.ac.rw</td>
                        <td>+250 789 987 654</td>
                        <td class="actions">
                            <button class="edit"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Adding Supervisor -->
    <div id="addSupervisorModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add New Supervisor</h2>
            <form>
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>

                <button type="submit">Add Supervisor</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to Handle Modal Interaction -->
    <script>
        // Get modal and button
        var modal = document.getElementById("addSupervisorModal");
        var btn = document.getElementById("addSupervisorBtn");
        var span = document.getElementById("closeModal");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
