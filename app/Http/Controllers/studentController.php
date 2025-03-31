<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\project;
use App\Models\department;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Else_;

class StudentController extends Controller
{
    // Show Registration Form
    public function student()
    {
        return view('student.register');
    }

   

    // Register Student
    public function register(Request $request)
    {
        // Validate Request
        $request->validate([
            'StudentRegNumber' => 'required|unique:students,StudentRegNumber',
            'StudentFirstName' => 'required',
            'StudentLastName' => 'required',
            'StudentEmail' => 'required|email|unique:students,StudentEmail',
            'StudentPhoneNumber' => 'required',
            'password' => 'required'
        ]);

        // Create New Student
        $st = new Student();
        $st->StudentRegNumber = $request->StudentRegNumber;
        $st->StudentFirstName = $request->StudentFirstName;
        $st->StudentLastName = $request->StudentLastName;
        $st->StudentEmail = $request->StudentEmail;
        $st->StudentPhoneNumber = $request->StudentPhoneNumber;
        $st->password = Hash::make($request->password); // Encrypt password
        
        if ($st->save()) {
            return redirect()->route('student.login')->with('success', 'Registration successful! Please log in.');
        } else {
            return redirect()->route('student.showregister')->with('error', 'Registration failed! Please try again.');
        }
    }



    // Show Login Form
    public function showLogin()
    {
        return view('student.login');
    }

    // Login Student
    public function login(Request $request)
    {
        $request->validate([
            'StudentRegNumber' => 'required',
            'password' => 'required'
        ]);

        // Find student by registration number
        $student = Student::where('StudentRegNumber', $request->StudentRegNumber)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            // Store student session
            session(['student_id' => $student->StudentRegNumber]);
            return  redirect()->route('student.studentdashboard')->with('success', 'Login successful!');

        } else {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    // Logout Student
    public function logout()
    {
        session()->forget('student_id');
        return redirect(route('student.login'))->with('success', 'You have logged out.');
    }
    public function studentdashboard()
    {
        // Get logged-in student
        $studentRegNumber = session('student_id');
        
        if (!$studentRegNumber) {
            return redirect()->route('student.login')->with('error', 'Please log in first.');
        }
        
        // Find the student
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
        
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }
        
        // Fetch projects related to the student, including the supervisor
        $projects = Project::where('StudentRegNumber', $studentRegNumber)
                           ->with('supervisor') // Eager load the supervisor relationship
                           ->get();
        
        // Count the number of projects
        $projectCount = $projects->count();
        
        // Get unique supervisors assigned to the student's projects
        $supervisorCount = $projects->pluck('SupervisorEmail')->filter()->unique()->count();
        
        return view('student.studentdashboard', compact('student', 'projects', 'projectCount', 'supervisorCount'));
    }
    
    public function supervisors()
    {
        // Get logged-in student
        $studentRegNumber = session('student_id');
        
        if (!$studentRegNumber) {
            return redirect()->route('student.login')->with('error', 'Please log in first.');
        }
        
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
        
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }
        
        // Fetch the assigned supervisor for the student
        $supervisor = $student->supervisor;  // Assuming you have a relationship method defined in the Student model
    
        // Check if the student has an assigned supervisor
        if (!$supervisor) {
            // If no supervisor is assigned, redirect to a different view (showsupervisor1)
            return view('student.showsupervisor1', compact('student', 'supervisor'))->with('error', 'No supervisor assigned.');
        }
        
        // If supervisor is assigned, show the assigned supervisor's details
        return route('student.supervisor', compact('student', 'supervisor'));
    }
    
    
    
        
  
    
    public function submitproposal()
    {
        // Get logged-in student
        $studentRegNumber = session('student_id');
    
        if (!$studentRegNumber) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
    
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }
    
        // Fetch all departments
        $departments = Department::all();
    
        return view('student.submitproposal', compact('student', 'departments'));
    }
    

        
    
    public function submitProposalstore(Request $request)
    {
        // Validate Request
        $request->validate([
            'ProjectCode' => 'required|unique:projects,ProjectCode',
            'ProjectName' => 'required|string|max:255',
            'ProjectProblems' => 'required|string',
            'ProjectSolutions' => 'required|string',
            'ProjectAbstract' => 'required|string',
            'DepartmentCode' => 'required|exists:departments,DepartmentCode',
            'ProjectDissertation' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'ProjectSourceCodes' => 'required|file|mimes:zip,rar|max:5120', // Max 5MB
        ]);
    
        // Get logged-in student
        $studentRegNumber = session('student_id');
    
        if (!$studentRegNumber) {
            return redirect()->route('student.login')->with('error', 'Please log in first.');
        }
    
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
    
        if (!$student) {
            return back()->with('error', 'Student not found. Please try again.');
        }
    
        try {
            // Upload Files
            $dissertationPath = $request->file('ProjectDissertation')->storeAs(
                'projects/dissertations', 
                $request->ProjectCode . '_dissertation.' . $request->file('ProjectDissertation')->getClientOriginalExtension(),
                'public'
            );
    
            $sourceCodePath = $request->file('ProjectSourceCodes')->storeAs(
                'projects/source_codes', 
                $request->ProjectCode . '_source_codes.' . $request->file('ProjectSourceCodes')->getClientOriginalExtension(),
                'public'
            );
    
            // Create New Project (without assigning a supervisor)
            $project = Project::create([
                'ProjectCode' => $request->ProjectCode,
                'ProjectName' => $request->ProjectName,
                'ProjectProblems' => $request->ProjectProblems,
                'ProjectSolutions' => $request->ProjectSolutions,
                'ProjectAbstract' => $request->ProjectAbstract,
                'DepartmentCode' => $request->DepartmentCode,
                'ProjectDissertation' => $dissertationPath,
                'ProjectSourceCodes' => $sourceCodePath,
                'StudentRegNumber' => $student->StudentRegNumber, // Associate project with student
                'Status' => 'Pending', // Default status
                'SupervisorEmail' => null, // Supervisor is not assigned yet
            ]);
    
            return redirect()->route('student.studentdashboard')->with('success', 'Project Proposal Submitted Successfully!');
        } catch (\Exception $e) {
            Log::error('Project Submission Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while submitting the project. Please try again.');
        }
    }
}
