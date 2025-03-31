<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class settingController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('student.login');
    }

    // Handle Login
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
            return redirect()->route('student.studentdashboard')->with('success', 'Login successful!');
        } else {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    // Handle Logout
    public function logout(Request $request)
    {
        // Clear the student session
        session()->forget('student_id');

        // Redirect to login page
        return redirect()->route('student.login')->with('success', 'You have been logged out.');
    }

    // Show Dashboard
    public function dashboard()
    {
        // Fetch the student ID from the session
        $studentId = session('student_id');

        // Find the student by registration number
        $student = Student::where('StudentRegNumber', $studentId)->first();

        // If student not found, redirect to login
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Please login to access the dashboard.');
        }

        // Fetch projects or other data for the dashboard
        $projects = $student->projects; // Assuming a relationship is defined

        return view('student.dashboard', ['student' => $student, 'projects' => $projects]);
    }

    // Show Settings Page
    public function settings()
    {
        // Fetch the student ID from the session
        $studentId = session('student_id');

        // Find the student by registration number
        $student = Student::where('StudentRegNumber', $studentId)->first();

        // If student not found, redirect to login
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Please login to access settings.');
        }

        return view('project.setting', ['student' => $student]);
    }

    // Update Settings
    public function updateSettings(Request $request)
{
    // Fetch the student ID from the session
    $studentId = session('student_id');

    // Find the student by registration number
    $student = Student::where('StudentRegNumber', $studentId)->first();

    // If student not found, redirect to login
    if (!$student) {
        return redirect()->route('student.login')->with('error', 'Please login to access settings.');
    }

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,StudentEmail,' . $student->StudentRegNumber . ',StudentRegNumber',
        'phone' => 'nullable|string|max:20',
        'current_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
    ]);

    // Prepare data for update
    $updateData = [
        'StudentFirstName' => explode(' ', $request->name)[0],
        'StudentLastName' => explode(' ', $request->name)[1] ?? '',
        'StudentEmail' => $request->email,
        'StudentPhoneNumber' => $request->phone,
    ];

    // Update password if provided
    if ($request->filled('current_password') && $request->filled('new_password')) {
        if (Hash::check($request->current_password, $student->password)) {
            $updateData['password'] = Hash::make($request->new_password);
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
    }

    // Update student record
    Student::where('StudentRegNumber', $studentId)->update($updateData);

    // Redirect back with success message
    return redirect()->route('student.settings')->with('success', 'Settings updated successfully!');
}
}