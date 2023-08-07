<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use App\Http\Controllers\Controller;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $ekskul = Extracurricular::get();
       return view('extracurricular',['ekskulList'=>$ekskul]);
    }

    public function show($id)
    {
        $ekskul = Extracurricular::with('students')
          ->findOrFail($id);
        return view('extracurricular-detail',['ekskul'=> $ekskul]);
    }
}
