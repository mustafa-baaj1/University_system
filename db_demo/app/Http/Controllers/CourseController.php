<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('courses.index');
    }
}

