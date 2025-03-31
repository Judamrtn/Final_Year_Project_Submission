<!-- Sidebar -->
<div class="sidebar bg-dark text-white vh-100 position-fixed">
    <div class="p-3">
        <!-- Student Information -->
       

        <h5 class="text-center">Student Panel</h5>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="{{ route('student.studentdashboard') }}" class="nav-link text-white">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('projects.index') }}" class="nav-link text-white">
                    <i class="fas fa-project-diagram me-2"></i> My Projects
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="fas fa-users me-2"></i> Supervisors
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.submitproposal') }}" class="nav-link text-white">
                    <i class="fas fa-edit me-2"></i> Submit Proposal
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="fas fa-cogs me-2"></i> Settings
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .sidebar {
        width: 250px;
        height: 100vh;
    }

    .nav-link {
        padding: 10px;
        border-radius: 5px;
    }

    .nav-link:hover {
        background-color: #1abc9c;
    }
</style>
