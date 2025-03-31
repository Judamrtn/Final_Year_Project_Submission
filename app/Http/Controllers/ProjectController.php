<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use App\Models\department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    // View all projects
    public function index()
    {
        // Retrieve student registration number from session
        $studentRegNumber = session('student_id');
    
        // Fetch student details
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
    
        // Ensure student exists before querying projects
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }
    
        // Fetch the student's projects (assuming there's a student_id column in the projects table)
        $projects = Project::where('StudentRegNumber', $student->StudentRegNumber)->get();
    
        return view('project.index', compact('student', 'projects'));
    }
    
    public function index1()
    {
        $projects = Project::all(); // Fetch all projects from the database
        return view('projects.index', compact('projects'));
    }

    // Show edit form for a project
    public function view($id)
    {
        // Retrieve the student from the session
        $studentRegNumber = session('student_id'); 
    
        if (!$studentRegNumber) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
        $project = Project::findOrFail($id);
    
        return view('project.view', compact('project', 'student'));
    }
    

    // Show edit form for a project
    public function edit($id)
    {
        // Get logged-in student
        $studentRegNumber = session('student_id');
        
        if (!$studentRegNumber) {
            return redirect()->route('student.login')->with('error', 'Please log in first.');
        }
    
        // Fetch the student record
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
    
        // Fetch the project you want to edit
        $project = Project::findOrFail($id);
    
        // Fetch all departments
        $departments = Department::all();
    
        // Return the view and pass the necessary data (student, project, departments)
        return view('project.edit', compact('student', 'project', 'departments'));
    }
    
    

    // Update a project
    public function update(Request $request, $id)
    {
        // Validate Request
        $request->validate([
            'ProjectCode' => 'required|exists:projects,ProjectCode', // Ensure ProjectCode exists
            'ProjectName' => 'required|string|max:255',
            'ProjectProblems' => 'required|string',
            'ProjectSolutions' => 'required|string',
            'ProjectAbstract' => 'required|string',
            'DepartmentCode' => 'required|exists:departments,DepartmentCode',
            'ProjectDissertation' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Optional file
            'ProjectSourceCodes' => 'nullable|file|mimes:zip,rar|max:5120', // Optional file
        ]);
    
        // Get logged-in student
        $studentRegNumber = session('student_id');
    
        if (!$studentRegNumber) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    
        $student = Student::where('StudentRegNumber', $studentRegNumber)->first();
    
        if (!$student) {
            return back()->with('error', 'Student not found. Please try again.');
        }
    
        try {
            // Find the existing project
            $project = Project::findOrFail($id);
    
            // Upload new dissertation file if it exists
            if ($request->hasFile('ProjectDissertation')) {
                // Delete old file if it exists
                if ($project->ProjectDissertation && Storage::exists($project->ProjectDissertation)) {
                    Storage::delete($project->ProjectDissertation);
                }
    
                // Store the new file
                $dissertationPath = $request->file('ProjectDissertation')->storeAs(
                    'projects/dissertations',
                    $request->ProjectCode . '_dissertation.' . $request->file('ProjectDissertation')->getClientOriginalExtension(),
                    'public'
                );
                $project->ProjectDissertation = $dissertationPath;
            }
    
            // Upload new source code file if it exists
            if ($request->hasFile('ProjectSourceCodes')) {
                // Delete old file if it exists
                if ($project->ProjectSourceCodes && Storage::exists($project->ProjectSourceCodes)) {
                    Storage::delete($project->ProjectSourceCodes);
                }
    
                // Store the new file
                $sourceCodePath = $request->file('ProjectSourceCodes')->storeAs(
                    'projects/source_codes',
                    $request->ProjectCode . '_source_codes.' . $request->file('ProjectSourceCodes')->getClientOriginalExtension(),
                    'public'
                );
                $project->ProjectSourceCodes = $sourceCodePath;
            }
    
            // Update the project details
            $project->update([
                'ProjectName' => $request->ProjectName,
                'ProjectProblems' => $request->ProjectProblems,
                'ProjectSolutions' => $request->ProjectSolutions,
                'ProjectAbstract' => $request->ProjectAbstract,
                'DepartmentCode' => $request->DepartmentCode,
                'Status' => 'Pending', // Assuming you want to set the status to 'Pending' on update as well
            ]);
    
            return redirect()->route('student.studentdashboard')->with('success', 'Project Proposal Updated Successfully!');
        } catch (\Exception $e) {
            Log::error('Project Update Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the project. Please try again.');
        }
    }
    

    // Delete a project
    public function destroy($id)
    {
        $project = Project::findOrFail($id); // Find the project by ID
        $project->delete(); // Delete the project

        return redirect()->route('student.studentdashboard')->with('success', 'Project deleted successfully!');
    }}

