<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class ClassController extends Controller
{
    public function createClass(Request $request)
    {
        
    }

    public function addStudent(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|exists:student,id',
        'class_id' => 'required|exists:classes,id'
        ]);
        dd($data);
        
        $student = Student::findOrFail($data['student_id']);
        $class = ClassModel::findOrFail($data['class_id']);
        
        $student->classes()->attach($class->id);

        return response()->json([
        'message' => 'Aluno adicionado à turma com sucesso',
        'student' => $student    
        ]);
    }
}
