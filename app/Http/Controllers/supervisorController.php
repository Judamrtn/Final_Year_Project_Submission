<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

class SupervisorController extends Controller
{
    // Show the page where supervisors can be assigned to students
    public function showAssignSupervisorForm()
    {
        // Fetch students and available supervisors
        $students = Student::with('project')->get();
        $supervisors = Supervisor::all();

        return view('department.assign-supervisor', compact('students', 'supervisors'));
    }

    // Assign a supervisor to a student
    public function assignSupervisor(Request $request, $studentId)
    {
        // Validate request
        $request->validate([
            'supervisor_email' => 'required|exists:supervisors,SupervisorEmail',
        ]);
    
        // Find student
        $student = Student::findOrFail($studentId);
    
        // Debug: Check if the student has a project
        if (!$student->project) {
            return redirect()->route('department.deptdashboard')->with('error', 'Student does not have a project assigned.');
        }
    
        // Assign supervisor to student's project
        $student->project->SupervisorEmail = $request->supervisor_email;
    
        // Save the project
        if ($student->project->save()) {
            return redirect()->route('department.deptdashboard')->with('success', 'Supervisor assigned successfully!');
        } else {
            return redirect()->route('department.deptdashboard')->with('error', 'Failed to assign supervisor. Please try again.');
        }
 
   

    }
  





    // Supervisor Loginclass SupervisorController extends Controller

    public function showDashboard()
    {
        // Check if supervisor is logged in
        if (!Session::has('is_supervisor_logged_in')) {
            return redirect()->route('supervisor.login')->with('error', 'Please log in first.');
        }

        $projects = Project::where('SupervisorID', session('supervisor_id'))->get();

        return view('supervisor.dashboard', compact('projects'));
    }

    public function logout(Request $request)
    {
        // Clear session data
        Session::forget('is_supervisor_logged_in');
        Session::forget('supervisor_id');
        Session::flush();

        return redirect()->route('supervisor.login')->with('success', 'Logged out successfully.');
    }


    // Supervisor Change Password
    public function showChangePasswordForm()
    {
        if (!Session::has('is_supervisor_logged_in')) {
            return redirect()->route('supervisor.login')->with('error', 'Please log in first.');
        }

        return view('supervisor.change-password');
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        session(['is_supervisor_logged_in' => true]);
        return redirect()->route('supervisor.dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $supervisor = \App\Models\Supervisor::where('SupervisorEmail', Session::get('supervisor_email'))->first();

        if ($supervisor && $request->old_password === $supervisor->password) { // Use hashing in production
            $supervisor->update(['password' => $request->new_password]); // Use bcrypt() in production

            return redirect()->route('supervisor.dashboard')->with('success', 'Password updated successfully.');
        }

        return back()->with('error', 'Incorrect old password.');
    }

    // Supervisor Logout
   


}