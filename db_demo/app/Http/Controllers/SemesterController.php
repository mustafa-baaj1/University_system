<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('semesters.index');
    }
}

