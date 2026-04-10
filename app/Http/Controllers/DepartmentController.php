<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        // Get authenticated user using Laravel's session-based auth
        $user = Auth::user();
        dd($user);
       // dd(session()->getId(),DB::table('sessions')->where('id', session()->getId())->first(), request()->cookie("laravel-session"));


        // Return view without database data - using dummy data in blade
        $departments = Department::all();//select * from departments
        return view('departments.index', compact('departments'));
    }

    public function store(Request $request){
        $request->validate([
            "name"=>"required|string|max:255|min:3",
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success','Department created successfully');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            "name"=>"required|string|max:255|min:3",
            "parent_id"=>"nullable|exists:departments,id",
        ]);
        Department::find($id)->update($validated);
        return redirect()->route('departments.index')->with('success','Department updated successfully');
    }

    public function delete($id){
        Department::find($id)->delete();
        return redirect()->route('departments.index')->with('success','Department deleted successfully');
    }



}

