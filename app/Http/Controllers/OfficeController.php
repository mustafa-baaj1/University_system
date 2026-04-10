<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        // Return view without database data - using dummy data in blade
        return view('offices.index');
    }
}

