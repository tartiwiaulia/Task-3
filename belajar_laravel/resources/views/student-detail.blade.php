@extends('layouts.mainlayout')

@section('title', 'Students')
    
@section('content')


<h2>
    Anda sedang melihat data detail dari siswa yang bernama {{$student->name}}
</h2>

<div class="my-3 d-flex justify-content-center">
    @if($student->image !='')
    <img src="{{asset('storage/photo/'.$student->image)}}" alt="" width="200px">
    @else
    <img src="{{asset('images/students.jpg')}}" alt="" width="200px">
    @endif
</div>
    
    <div clas="mt-5 mb-5">
    <table class="table table-bordered">
        <tr>
            <th>NIS</th>
            <th>Gender</th>
            <th>Class</th>
            <th>Homeroom Teacher</th>
        </tr>
        <tr>
            <td>{{$student->nis}}</td>
            <td>
                @if ($student->gender == 'P')
                      Perempuan
                @else
                      Laki-Laki
                @endif
            </td>
            <td>{{$student->class->name}}</td>
            <td>{{$student->class->homeroomTeacher->name}}</td>
        </tr>
    </table>
    </div>

    <div>
        <h3>Extracurriculars</h3>
        <ol>
        @foreach ($student->extracurriculars as $item)
            <li>{{$item->name}}</li>
        @endforeach
        </ol>
    </div>

    <style>
        th {
            width: 25%;
        }
    </style>
@endsection