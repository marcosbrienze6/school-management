<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Grades;



class ClassController extends Controller
{
    public function createClass(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|exists,id',
        'grade_id' => 'required|exists:grades,id',
        ]);

        $class = ClassModel::create([
        'name' => $data['name'],
        'student_id' => $data['student,id'],
        'grade_id' => $data['grade_id'],
        ]);

        return response()->json([
        'message' => 'Turma criada com sucesso',
        'class' => $class
        ]);
    }

    public function addStudentToClass(Request $request)
    {
        $data = $request->validate([
        'class_id' => 'required|exists:classes,id',
        'student_id' => 'required|exists:students,id',
        ]);

        $class = ClassModel::findOrFail($data['class_id']);
        $student = Student::findOrFail($data['student_id']);

        if ($class->students()->where('student_id', $student->id)->exists()) {
            return response()->json(['message' => 'O aluno já está nesta turma.'], 400);
        }

        $class->students()->attach($student->id);

        return response()->json([
        'message' => 'Aluno adicionado à turma com sucesso',
        'class' => $class,
        'student' => $student
        ]);
    }
}
