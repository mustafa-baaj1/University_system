<?php

namespace App\Http\Controllers;

use App\Events\testevent;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        if(Auth::user()->role == 'student'){
            $programs = Auth::user()->student->program()->get();
        }
        else if(Auth::user()->role == 'admin'){
            $programs = Program::all();
        }

        return view('programs.index', compact('programs'));
    }
}

