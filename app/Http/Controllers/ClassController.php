<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\ClassRequest;

use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\Student;

class ClassController extends Controller
{
    public function createClass(ClassRequest $request)
    {
        $data = $request->validated();

        $class = ClassModel::create([
        'name' => $data['name'],
        'grade_id' => $data['grade_id'],
        ]);

        return response()->json([
        'message' => 'Turma criada com sucesso',
        'class' => $class
        ]);
    }

    public function addStudent(AddStudentRequest $request)
    {
        $data = $request->validated();
        
        $class = ClassModel::findOrFail($data['class_id']);
        $student = Student::findOrFail($data['student_id']);

        $class = ClassStudent::create($data);

        return response()->json([
        'message' => 'Aluno adicionado à turma com sucesso',
        'class' => $class,
        'student' => $student
        ]);
    }
}
