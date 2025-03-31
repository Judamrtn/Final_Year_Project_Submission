<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperController extends Controller
{
    // Show the supervisor dashboard
    public function edit(Supervisor $supervisor): View
    {
        // Fetch projects assigned to the supervisor
        $projects = Project::where('SupervisorEmail', $supervisor->SupervisorEmail)->get();

        // Fetch students assigned to the supervisor (via projects)
        $students = Student::whereIn('StudentRegNumber', $projects->pluck('StudentRegNumber'))->get();

        // Fetch the number of pending projects
        $pendingProjects = $projects->where('Status', 'Pending')->count();

        // Pass the data to the view
        return view('supervisor.superdashboard', compact('supervisor', 'projects', 'students', 'pendingProjects'));
    }

    // Approve a project
    public function approve($projectCode)
    {
        // Find the project by ProjectCode
        $project = Project::findOrFail($projectCode);

        // Update the project status to "Approved"
        $project->Status = 'Approved';
        $project->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Project approved successfully!');
    }

    // Deny a project
    public function deny($projectCode)
    {
        // Find the project by ProjectCode
        $project = Project::findOrFail($projectCode);

        // Update the project status to "Denied"
        $project->Status = 'Denied';
        $project->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Project denied successfully!');
    }
}
