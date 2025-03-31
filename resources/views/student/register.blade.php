<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1abc9c;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            padding-left: 40px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .btn-custom {
            background-color: #1abc9c;
            color: white;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">Student Registration</div>
        @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
        <div class="card-body">
        <form action="{{ route('student.register') }}" method="POST">

                @csrf

                <!-- Student Registration Number -->
                <div class="form-group">
                    <label for="StudentRegNumber">Registration Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" id="StudentRegNumber" name="StudentRegNumber" required>
                    </div>
                </div>

                <!-- First Name -->
                <div class="form-group">
                    <label for="StudentFirstName">First Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="StudentFirstName" name="StudentFirstName" required>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label for="StudentLastName">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="StudentLastName" name="StudentLastName" required>
                    </div>
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label for="StudentGender">Gender</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" id="male" name="StudentGender" value="Male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="female" name="StudentGender" value="Female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="StudentEmail">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="StudentEmail" name="StudentEmail" required>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="StudentPhoneNumber">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" class="form-control" id="StudentPhoneNumber" name="StudentPhoneNumber" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Register</button>
                </div>
            </form>

            <!-- Login Link -->
            <p class="text-center mt-3">
                Already have an account? 
                <a href="{{ route('student.login') }}" class="link-primary">Login</a>
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
