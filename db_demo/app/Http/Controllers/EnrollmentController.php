<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('enrollments.index');
    }
}

