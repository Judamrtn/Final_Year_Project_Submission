<!-- Sidebar -->
<div class="sidebar">
    <h2>Department Panel</h2>
    <ul>
        <li><a href="{{ route('department.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('department.Addsupervisor')}}"><i class="fas fa-user"></i> Supervisors</a></li>
        <li><a href="#"><i class="fas fa-graduation-cap"></i> Students</a></li>
        
    </ul>
</div>

<style>
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
</style>
