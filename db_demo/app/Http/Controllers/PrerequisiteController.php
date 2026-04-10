<?php

namespace App\Http\Controllers;

use App\Models\Prerequisite;
use Illuminate\Http\Request;

class PrerequisiteController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('prerequisites.index');
    }
}

