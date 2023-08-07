<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return view('teacher',['teacherList'=>$teacher]);
    }

    public function show($id)
    {
        $teacher = Teacher::with('class.students')
           ->findOrFail($id);
        return view('teacher-detail',['teacher'=>$teacher]);
    }
}
