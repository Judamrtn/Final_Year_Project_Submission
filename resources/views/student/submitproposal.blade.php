<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Proposal</title>
    <script src="https://kit.fontawesome.com/c1fc850206.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
        }

        .content {
            margin-left: 280px;
            padding: 20px;
            width: calc(100% - 280px);
        }

        .navbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container-box {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            margin: auto;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #2ecc71;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    @include('student.sidebar', ['student' => $student])

    <div class="content">
        <div class="navbar">
            <h2>Welcome, {{ $student->StudentFirstName }}!</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-box">
            <h2 class="text-center">Submit Your Proposal</h2>
            <form action="{{ route('student.submitproposal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Project Code</label>
                <input type="text" name="ProjectCode" required>
                
                <label>Project Name</label>
                <input type="text" name="ProjectName" required>
                
                <label>Project Problems</label>
                <textarea name="ProjectProblems" rows="4" required></textarea>
                
                <label>Project Solutions</label>
                <textarea name="ProjectSolutions" rows="4" required></textarea>
                
                <label>Project Abstract</label>
                <textarea name="ProjectAbstract" rows="4" required></textarea>
                
                <label>Upload Dissertation</label>
                <input type="file" name="ProjectDissertation" required>
                
                <label>Upload Source Code</label>
                <input type="file" name="ProjectSourceCodes" required>
                
                <label>Department</label>
                <select name="DepartmentCode" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->DepartmentCode }}">{{ $department->DepartmentName }}</option>
                    @endforeach
                </select>
                
                <button type="submit">Submit Proposal</button>
            </form>
        </div>
    </div>
</body>
</html>