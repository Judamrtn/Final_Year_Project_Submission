<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Project;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display the department dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Fetch total supervisors
        $totalSupervisors = Supervisor::count();
        
        // Fetch total students
        $totalStudents = Student::count();
        
        // Fetch total assigned projects (assuming SupervisorEmail is the foreign key in the projects table)
        $totalAssignedProjects = Project::whereNotNull('SupervisorEmail')->count();
        
        // Fetch students with their projects and supervisors
        $students = Student::with(['project', 'project.supervisor'])->get();
    
        return view('department.deptdashboard', compact('totalSupervisors', 'totalStudents', 'totalAssignedProjects', 'students'));
    }

    /**
     * Display the add supervisor form.
     *
     * @return \Illuminate\View\View
     */
    public function addSupervisor()
    {
        // Fetch all supervisors from the database
        $supervisors = Supervisor::all();
    
        // Pass the supervisors variable to the view
        return view('department.Addsupervisor', compact('supervisors'));
    }

    /**
     * Store a newly created supervisor in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'SupervisorEmail' => 'required|email|unique:supervisors,SupervisorEmail',
            'SupervisorFirstName' => 'required|string|max:255',
            'SupervisorLastName' => 'required|string|max:255',
            'SupervisorPhoneNumber' => 'required|string|max:20',
        ]);
    
        // Create a new supervisor
        Supervisor::create([
            'SupervisorEmail' => $request->SupervisorEmail,
            'SupervisorFirstName' => $request->SupervisorFirstName,
            'SupervisorLastName' => $request->SupervisorLastName,
            'SupervisorPhoneNumber' => $request->SupervisorPhoneNumber,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('department.Addsupervisor')->with('success', 'Supervisor added successfully!');
    }
    /**
     * Assign a supervisor to a student's project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignSupervisor(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'supervisor_id' => 'required|exists:supervisors,id',
        ]);

        // Find the student's project
        $project = Project::where('student_id', $request->student_id)->first();

        if ($project) {
            // Assign the supervisor to the project
            $project->SupervisorEmail = $request->supervisor_id;
            $project->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Supervisor assigned successfully!');
    }
}