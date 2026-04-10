<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('assignments.index');
    }
}

