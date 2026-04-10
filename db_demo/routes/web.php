<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PrerequisiteController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\TeacherAssignmentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Department Routes
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{delete_id}', [DepartmentController::class, 'delete'])->name('departments.delete');

// Program Routes
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');

// Course Routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// Prerequisite Routes
Route::get('/prerequisites', [PrerequisiteController::class, 'index'])->name('prerequisites.index');

// Semester Routes
Route::get('/semesters', [SemesterController::class, 'index'])->name('semesters.index');

// Classroom Routes
Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');

// Section Routes
Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');

// Instructor Routes
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');

// Office Routes
Route::get('/offices', [OfficeController::class, 'index'])->name('offices.index');

// Student Routes
Route::get('/students/info', [StudentController::class, 'info'])->name('students.info');
Route::resource('students', StudentController::class);

// Enrollment Routes
Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');

// Teacher Assignment Routes
Route::get('/teacher-assignments', [TeacherAssignmentController::class, 'index'])->name('teacher-assignments.index');

// Assignment Routes
Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');

// Submission Routes
Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');

// Schema Visualizer - Load React App
Route::get('/schema', function () {
    return view('welcome');
})->name('schema');
