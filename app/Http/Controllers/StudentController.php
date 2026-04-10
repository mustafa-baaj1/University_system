<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::all();
        $programs = Program::all();
        return view('students.index' ,["students"=>$students,"programs"=>$programs]);
    }

    public function store(Request $request){

        $validated = Validator::make($request->all(),[
            "name"=>"required",
            "phone"=>"required",
            "email"=>"required",
            "address"=>"required",
            "program_id"=>"required"

        ]);

        $student = Student::create($validated->validate());

        $student->addMedia($request->image)->toMediaCollection("student_images");
        return redirect()->route("students.index")->with("success","Student created successfully");
    }

    public function info(){

        $student = Student::find(Auth::user()->student->id);

        $students = StudentInfo::where("id", $student->id)->get();


        return view('students.students_info', compact('students'));
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
       if($request->hasFile("image")){

        if($student->hasMedia("student_images")){// if user has image uploaded before
            $student->clearMediaCollection("student_images");
            $student->addMedia($request->image)
            ->withCustomProperties(
                ["metadata"=>"user has uploaded image before",
                "uploaded_at"=>now(),
                "sizes"=>$request->image->getSize(),
            ])
            ->toMediaCollection("student_images");
       }
       else{//if user doesn't have image uploaded before
       $student->addMedia($request->image)
       ->withCustomProperties(
        ["metadata"=>"user has not uploaded image before",
        "uploaded_at"=>now(),
        "sizes"=>$request->image->getSize(),
       ])
       ->toMediaCollection("student_images");
       }
    }
    return redirect()->route("students.index")->with("success","Student updated successfully");

    }
}

