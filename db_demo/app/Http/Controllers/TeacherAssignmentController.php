<?php

namespace App\Http\Controllers;

use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class TeacherAssignmentController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('teacher-assignments.index');
    }
}

