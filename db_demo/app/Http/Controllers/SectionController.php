<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('sections.index');
    }
}

