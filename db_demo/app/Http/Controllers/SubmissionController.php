<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('submissions.index');
    }
}

