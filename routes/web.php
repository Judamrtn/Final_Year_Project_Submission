<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\supervisorController;
use App\Http\Controllers\superController;
use App\Http\Controllers\SupervisorFirstLoginController;



Route::get('/', function () {
    return view('welcome');
});

// Admin and Department Routes
Route::get('/dashboard', [App\Http\Controllers\adminController::class, 'index']);
Route::get('/department', [App\Http\Controllers\departmentController::class, 'dashboard'])->name('/admin');
Route::get('/student', [App\Http\Controllers\studentController::class, 'student'])->name('/student');

// Supervisor Authentication Routes
Route::get('/supervisor', [SupervisorFirstLoginController::class, 'showFirstLoginForm'])->name('supervisor.login');
Route::get('/supervisor/login', function () {
    return view('supervisor.superlogin');
})->name('supervisor.login');
Route::post('/supervisor/login', [SupervisorController::class, 'login'])->name('supervisor.makelogin');
Route::get('/supervisor/change-password', [SupervisorController::class, 'showChangePasswordForm'])->name('supervisor.change-password');
Route::post('/supervisor/change-password', [SupervisorController::class, 'changePassword'])->name('supervisor.update-password');

// Supervisor Dashboard & Logout with Middleware
Route::get('/supervisor/dashboard', [SupervisorController::class, 'showDashboard'])
    ->middleware('supervisor.auth')
    ->name('supervisor.dashboard');



Route::post('/supervisor/logout', [SupervisorController::class, 'logout'])->name('supervisor.logout');

Route::get('/student/register', [StudentController::class, 'student'])->name('student.showregister');
Route::post('/student/register', [StudentController::class, 'register'])->name('student.register');

Route::get('/student/login', [StudentController::class, 'showLogin'])->name('student.login');
Route::post('/student/login', [StudentController::class, 'login'])->name('student.makelogin');
Route::get('/student/logout', [StudentController::class, 'logout'])->name('logout');

Route::get('/student/dashboard', [StudentController::class, 'studentdashboard'])->name('student.studentdashboard');
Route::get('/student/submitproposal', [StudentController::class, 'submitproposal'])->name('student.submitproposal');
Route::post('/student/submitproposal', [StudentController::class, 'submitProposalstore'])->name('student.submitproposal.store');

Route::get('/settings', [settingController::class, 'settings'])->name('student.settings');
Route::put('/settings/update', [settingController::class, 'updateSettings'])->name('student.settings.update');

Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/submitproposal', [StudentController::class, 'submitProposalForm'])->name('student.submitproposal.form');

// View projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{ProjectCode}/view', [ProjectController::class, 'view'])->name('projects.view');

// Edit project (show edit form)
Route::get('/projects/{ProjectCode}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

// Update project (handle edit form submission)
Route::put('/projects/{ProjectCode}', [ProjectController::class, 'update'])->name('projects.update');

// Delete project
Route::delete('/projects/{ProjectCode}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/student/supervisor', [supervisorController::class, 'supervisor'])->name('super');

use App\Http\Controllers\adminController;

// Admin Registration Routes
Route::get('/admin/register', [adminController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [adminController::class, 'register'])->name('admin.register.submit');

// Admin Login Routes
Route::get('/admin/login', [adminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [adminController::class, 'login'])->name('admin.login.submit');

// Admin Logout Route
Route::post('/admin/logout', [adminController::class, 'logout'])->name('admin.logout');

Route::get('/department/dashboard', [departmentController::class, 'dashboard'])->name('department.dashboard');

// Add Supervisor Form
Route::get('/department/add-supervisor', [DepartmentController::class, 'addSupervisor'])->name('department.Addsupervisor');

// Store Supervisor
Route::post('/supervisors/store', [DepartmentController::class, 'store'])->name('supervisors.store');

// Assign Supervisor to Student
Route::post('/assign-supervisor', [DepartmentController::class, 'assignSupervisor'])->name('assign.supervisor');

// Edit Supervisor Route
Route::get('/supervisors/{supervisor}/edit', [SupervisorController::class, 'edit'])->name('supervisors.edit');

// Delete Supervisor Route
Route::delete('/supervisors/{supervisor}', [SupervisorController::class, 'destroy'])->name('supervisors.destroy');

// Supervisor Edit Route with Middleware
Route::get('/supervisor', [superController::class, 'edit'])
    ->name('supervisor.edit')
  ;


// Show the first login form
Route::get('/supervisor/first-login', [SupervisorFirstLoginController::class, 'showFirstLoginForm'])->name('supervisor.first-login');

// Handle the first login form submission
Route::post('/supervisor/first-login', [SupervisorFirstLoginController::class, 'handleFirstLogin'])->name('supervisor.first-login.submit');

// Approve a project
Route::put('/project/{projectCode}/approve', [superController::class, 'approve'])->name('project.approve');

// Deny a project
Route::put('/project/{projectCode}/deny', [superController::class, 'deny'])->name('project.deny');
Route::get('/student/supervisors', [StudentController::class, 'supervisors'])->name('student.supervisors');