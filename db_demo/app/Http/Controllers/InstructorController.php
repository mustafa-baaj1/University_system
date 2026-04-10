<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('instructors.index');
    }
}

