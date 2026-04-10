<?php

namespace App\Http\Controllers;

use App\Events\testevent;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        
        // Return view without database data - using dummy data in blade
        return view('classrooms.index');
    }
}

